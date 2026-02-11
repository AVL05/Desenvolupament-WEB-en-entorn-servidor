@extends('layouts.master')

@section('content')

<div class="row">

    <div class="col-sm-4">
        <img src="{{$book->cover}}" class="img-fluid rounded shadow-lg border">
    </div>

    <div class="col-sm-8">
        <h2 class="fw-bold">{{$book->title}}</h2>
        <h5 class="text-muted">Año: {{$book->year}}</h5>
        <h5 class="text-muted">Autor: {{$book->author}}</h5>

        <div class="my-3">
            <strong>Estado:</strong>
            @if($book->available)
                <span class="badge bg-success">Libro disponible</span>
                <p class="mt-2">
                    <button class="btn btn-primary">Prestar libro</button>
                    <!-- Nota: El botón de prestar es visual en este ejercicio, no requiere lógica extra en backend salvo que se pida -->
                </p>
            @else
                <span class="badge bg-danger">Libro prestado</span>
                <p class="mt-2">
                    <button class="btn btn-danger">Devolver libro</button>
                </p>
            @endif
        </div>

        <p class="lead">{{$book->synopsis}}</p>

        <div class="mt-4">
            <a href="{{ url('/catalog/edit/' . $book->id) }}" class="btn btn-warning text-white">
                ✏️ Editar libro
            </a>
            <a href="{{ url('/catalog') }}" class="btn btn-outline-dark ms-2">
                < Volver al listado
            </a>
        </div>
    </div>
</div>

@endsection
