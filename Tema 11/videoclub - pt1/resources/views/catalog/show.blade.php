@extends('layouts.master')

@section('content')
<div class="row">

    <div class="col-sm-4">
        {{-- Imagen de la película --}}
        <img src="{{ $pelicula->poster }}" style="width: 100%;" />
    </div>
    <div class="col-sm-8">
        {{-- Datos de la película --}}
        <h1>{{ $pelicula->title }}</h1>
        <h4>Año: {{ $pelicula->year }}</h4>
        <h4>Director: {{ $pelicula->director }}</h4>

        <p><strong>Resumen:</strong> {{ $pelicula->synopsis }}</p>

        <p><strong>Estado:</strong>
            @if($pelicula->rented)
                Película actualmente alquilada
            @else
                Película disponible
            @endif
        </p>

        @if($pelicula->rented)
            <a class="btn btn-danger" href="#">Devolver película</a>
        @else
            <a class="btn btn-primary" href="#">Alquilar película</a>
        @endif

        <a class="btn btn-warning" href="{{ url('/catalog/edit/' . $pelicula->id ) }}">
            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
            Editar película
        </a>
        <a class="btn btn-outline-dark" href="{{ url('/catalog') }}">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            Volver al listado
        </a>

    </div>
</div>
@stop
