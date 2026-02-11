@extends('layouts.master')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card p-4">
            <h2 class="text-center mb-4">Añadir nuevo libro</h2>

            <form action="{{ url('/catalog/create') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Título</label>
                    <input type="text" name="title" id="title" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="year" class="form-label">Año</label>
                    <input type="text" name="year" id="year" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="author" class="form-label">Autor</label>
                    <input type="text" name="author" id="author" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="cover" class="form-label">URL Portada</label>
                    <input type="url" name="cover" id="cover" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="synopsis" class="form-label">Resumen / Sinopsis</label>
                    <textarea name="synopsis" id="synopsis" class="form-control" rows="4" required></textarea>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-4">Añadir libro</button>
                    <a href="{{ url('/catalog') }}" class="btn btn-link">Cancelar</a>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection
