<?php
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use Dotenv\Validator;
use Illuminate\Http\Request;
use App\Receita;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/receitas', function () {
    $id_user = Auth::id();

    $receitas = Receita::orderBy('created_at', 'asc')->where('id_user', $id_user)->get();

    return view('receitas.receita', [
        'receitas' => $receitas
    ]);
})->middleware("auth");


Route::post('/receita', function (Request $request) {

    $rules = [
        'title' => 'required|max:255',
        'ingredient' => 'required',
        'preparation' => 'required'
    ];

    $messages = [
        'title.required' => 'É obrigatório inserir um título na receita',
        'preparation.required' => 'É obrigatório inserir um modo de preparo na receita',
        'ingredient.required' => 'É obrigatório inserir ingredientes na receita',
    ];


    $validator = Validator($request->all(),$rules,$messages);

    if($validator->fails())
    {
        return redirect('/receitas')
            ->withInput()
            ->withErrors($validator);
    }

    //else create recipe
    $id_user = Auth::id();
    $receita = new Receita();
    $receita->title = $request->title;
    $receita->preparation = $request->preparation;
    $receita->ingredient = $request->ingredient;
    $receita->id_user = $id_user;

    $receita->save();

    return redirect('/receitas');
});

Route::delete('/receita/{receita}', function (Receita $receita) {
    $receita->delete();

    return redirect('/receitas');
});
