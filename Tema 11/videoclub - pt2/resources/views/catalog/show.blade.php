@extends('layouts.master')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <h2>Detalle de la Película</h2>
            <hr>
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-4">
            <img src="{{ $pelicula->poster }}" class="img-fluid" alt="{{ $pelicula->title }}">
        </div>
        <div class="col-sm-8">
            <h3>{{ $pelicula->title }}</h3>
            <p><strong>Año:</strong> {{ $pelicula->year }}</p>
            <p><strong>Director:</strong> {{ $pelicula->director }}</p>
            <p><strong>Resumen:</strong></p>
            <p>{{ $pelicula->synopsis }}</p>
            
            <p><strong>Estado:</strong></p>
            @if($pelicula->rented)
                <p class="text-danger">Película actualmente alquilada</p>
                <a href="#" class="btn btn-danger">Devolver película</a>
            @else
                <p class="text-success">Película disponible</p>
                <a href="#" class="btn btn-primary">Alquilar película</a>
            @endif
            
            <div class="mt-3">
                <a href="{{ url('/catalog/edit/' . $pelicula->id) }}" class="btn btn-warning">
                    Editar película
                </a>
                <a href="{{ url('/catalog') }}" class="btn btn-secondary">
                    Volver al listado
                </a>
            </div>
        </div>
    </div>
@stop