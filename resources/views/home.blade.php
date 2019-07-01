@extends('layouts.app')

@section('content')
<div class="container">
    @auth
    <div class="row justify-content-center pb-2">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Minhas Receitas</div>

                <div class="card-body">
                    <a href="receitas">Acessar Minhas Receitas</a>
                </div>
            </div>
        </div>
    </div>
    @endauth
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Todas as Receitas</div>

                <div class="card-body">
                <ul>
                        <?php $count = 1; ?>
                        @foreach ($receitas as $receita)
                            <li class="pt-3">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h4>{{ $receita->title }}</h4>
                                    </div>
                                    <div class="col-sm-6 text-right">
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#recipeModal{{ $count }}" >Visualizar</button>
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
