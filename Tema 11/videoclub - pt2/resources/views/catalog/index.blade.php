@extends('layouts.master')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <h2>Catálogo de Películas</h2>
            <p>Listado completo de películas disponibles</p>
            <hr>
        </div>
    </div>
    
    <div class="row">
        @foreach($arrayPeliculas as $pelicula)
            <div class="col-xs-6 col-sm-4 col-md-3 text-center mb-4">
                <a href="{{ url('/catalog/show/' . $pelicula->id) }}" style="text-decoration: none; color: inherit;">
                    <img src="{{ $pelicula->poster }}" class="img-fluid" style="height:200px; object-fit: cover;" alt="{{ $pelicula->title }}"/>
                    <div style="min-height:45px; margin:5px 0 10px 0;">
                        <strong>{{ $pelicula->title }}</strong>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@stop