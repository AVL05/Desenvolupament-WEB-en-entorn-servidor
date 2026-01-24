@extends('layouts.app')

@section('content')
<div class="auth-card" style="max-width: 600px">
    <div class="auth-header">
        <h3>Editar Tarea #{{ $tarea->id }}</h3>
    </div>
    {{-- Formulario de edición. La acción apunta a la ruta update pasando la tarea --}}
    <form method="POST" action="{{ route('tareas.update', $tarea) }}">
        @csrf
        @method('PUT') {{-- Directiva para 'engañar' al navegador y enviar una petición PUT --}}
        
        <div class="form-group">
            <label for="nombre">Nombre de la tarea</label>
            {{-- value="{{ old('nombre', $tarea->nombre) }}" usa el valor antiguo si falla validación, O el valor actual de la BBDD --}}
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $tarea->nombre) }}" required>
            @error('nombre') <div style="color: var(--danger); font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div> @enderror
        </div>
        
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control" rows="4" required>{{ old('descripcion', $tarea->descripcion) }}</textarea>
            @error('descripcion') <div style="color: var(--danger); font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div> @enderror
        </div>
        
        <div class="actions" style="margin-top: 2rem;">
            <button type="submit" class="btn btn-primary">Actualizar Tarea</button>
            <a href="{{ route('tareas.index') }}" class="btn btn-secondary" style="margin-left: 1rem">Cancelar</a>
        </div>
    </form>
</div>
@endsection
