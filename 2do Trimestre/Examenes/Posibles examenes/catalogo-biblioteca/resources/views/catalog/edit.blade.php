@extends('layouts.master')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card p-4">
            <h2 class="text-center mb-4">Modificar libro</h2>

            <form action="{{ url('/catalog/edit/' . $book->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Título</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ $book->title }}" required>
                </div>

                <div class="mb-3">
                    <label for="year" class="form-label">Año</label>
                    <input type="text" name="year" id="year" class="form-control" value="{{ $book->year }}" required>
                </div>

                <div class="mb-3">
                    <label for="author" class="form-label">Autor</label>
                    <input type="text" name="author" id="author" class="form-control" value="{{ $book->author }}" required>
                </div>

                <div class="mb-3">
                    <label for="cover" class="form-label">URL Portada</label>
                    <input type="url" name="cover" id="cover" class="form-control" value="{{ $book->cover }}" required>
                </div>

                <div class="mb-3">
                    <label for="synopsis" class="form-label">Resumen / Sinopsis</label>
                    <textarea name="synopsis" id="synopsis" class="form-control" rows="4" required>{{ $book->synopsis }}</textarea>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-warning text-white px-4">Modificar libro</button>
                    <a href="{{ url('/catalog/show/' . $book->id) }}" class="btn btn-link">Cancelar</a>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection
