@extends('layouts.master')

@section('content')
    <div class="jumbotron text-center">
        <h1 class="display-4">Bienvenido al Videoclub</h1>
        <p class="lead">Pantalla principal</p>
        <hr class="my-4">
        <p>Gestiona tu colección de películas de forma sencilla</p>
        <a class="btn btn-primary btn-lg" href="{{ url('/catalog') }}" role="button">Ver Catálogo</a>
    </div>
@stop