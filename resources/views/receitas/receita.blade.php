@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Nova Receita</div>
                <div class="card-body">
                    @include('common.errors')
                    <form action="{{ url('receita') }}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        <!-- Task Name -->
                        <div class="form-group">
                            <label for="title" class="col-sm-3 control-label">Título</label>
                            <div class="col-sm-6">
                                <input type="text" name="title" id="task-name" class="form-control">
                            </div>

                            <label for="preparation" class="col-sm-3 control-label pt-2">Modo de Preparo</label>
                            <div class="col-sm-12">
                                <textarea name="preparation" class="form-control"></textarea>
                            </div>

                            <label for="ingredient" class="col-sm-5 control-label pt-2">Ingrediente</label>
                            <div class="col-sm-12 d-flex">
                                <textarea name="ingredient" class="form-control"></textarea>
                            </div>
                        </div>

                        <!-- Add Task Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-plus"></i> Salvar Receita
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center pt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>Minhas Receitas</h3></div>
                <div class="card-body">
                    <ul>
                        <?php $count = 1; ?>
                        @foreach ($receitas as $receita)

                            <li class="pt-3">
                                <div class="row">
                                    <div class="col-sm-6"><h4>{{ $receita->title }}</h4></div>
                                    <div class="col-sm-6 text-right">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#recipeModal{{ $count }}">Visualizar</button>
                                            
                                            <form action="{{ url('receita/'.$receita->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Excluir</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <div class="modal fade" id="recipeModal{{ $count }}" tabindex="-1" role="dialog" aria-labelledby="recipeModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="favoritesModalLabel">{{ $receita->title }}</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h3>Ingredientes</h3>
                                            <p>{{ $receita->ingredient }}</p>
                                            <h3>Modo de Preparo</h3>
                                            <p>{{ $receita->preparation }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php $count++; ?>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
