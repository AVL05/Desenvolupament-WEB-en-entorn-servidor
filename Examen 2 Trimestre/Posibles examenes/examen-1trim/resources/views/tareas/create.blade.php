@extends('layouts.app')

@section('content')
<div class="auth-card" style="max-width: 600px">
    <div class="auth-header">
        <h3>Nueva Tarea</h3>
    </div>
    {{-- Formulario para crear una nueva tarea --}}
    <form method="POST" action="{{ route('tareas.store') }}">
        @csrf {{-- Token de seguridad obligatorio en Laravel (protección CSRF) --}}
        
        <div class="form-group">
            <label for="nombre">Nombre de la tarea</label>
            {{-- value="{{ old('nombre') }}" mantiene el texto si hay error de validación --}}
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required>
            
            {{-- Muestra mensaje de error si la validación falla para este campo --}}
            @error('nombre') <div style="color: var(--danger); font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div> @enderror
        </div>
        
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control" rows="4" required>{{ old('descripcion') }}</textarea>
            @error('descripcion') <div style="color: var(--danger); font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div> @enderror
        </div>
        
        <div class="actions" style="margin-top: 2rem;">
            <button type="submit" class="btn btn-primary">Crear Tarea</button>
            <a href="{{ route('tareas.index') }}" class="btn btn-secondary" style="margin-left: 1rem">Cancelar</a>
        </div>
    </form>
</div>
@endsection
