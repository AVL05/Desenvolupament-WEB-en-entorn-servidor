@extends('layouts.app')

@section('content')
<div class="filter-bar">
    <form action="{{ route('tareas.index') }}" method="GET" style="display:contents">
        <div class="form-group" style="flex-grow: 1; margin:0">
            <label for="termino" style="font-size:0.875rem">Buscar</label>
            <input type="text" name="termino" class="form-control" placeholder="Nombre o descripción..." value="{{ request('termino') }}">
        </div>
        <div class="form-group" style="margin:0">
            <label for="estado" style="font-size:0.875rem">Estado</label>
            <select name="estado" class="form-control">
                <option value="">Todos</option>
                <option value="1" {{ request('estado') == '1' ? 'selected' : '' }}>Completadas</option>
                <option value="0" {{ request('estado') === '0' ? 'selected' : '' }}>Pendientes</option>
            </select>
        </div>
        <div class="form-group" style="margin:0">
             <label for="fecha_desde" style="font-size:0.875rem">Desde</label>
             <input type="date" name="fecha_desde" class="form-control" value="{{ request('fecha_desde') }}">
        </div>
        <div class="form-group" style="margin:0">
             <label for="fecha_hasta" style="font-size:0.875rem">Hasta</label>
             <input type="date" name="fecha_hasta" class="form-control" value="{{ request('fecha_hasta') }}">
        </div>
        <button type="submit" class="btn btn-primary">Filtrar</button>
        <a href="{{ route('tareas.index') }}" class="btn btn-secondary">Limpiar</a>
    </form>
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Fecha Creación</th>
                <th>Creador</th>
                <th>Última Modificación</th>
                <th>Completada</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tareas as $tarea)
            <tr>
                <td>{{ $tarea->id }}</td>
                <td>{{ $tarea->nombre }}</td>
                <td>{{ Str::limit($tarea->descripcion, 50) }}</td>
                <td>{{ $tarea->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ $tarea->creador->name ?? '-' }}</td>
                <td>
                    {{ $tarea->updated_at->format('d/m/Y') }}<br>
                    <small style="color:var(--text-muted)">{{ $tarea->modificador->name ?? '' }}</small>
                </td>
                <td>
                    @if($tarea->completada)
                        <span class="badge badge-success">Completada</span>
                        @if($tarea->fecha_finalizacion)
                        <div style="font-size: 0.7rem; color: #6b7280; margin-top:0.2rem">
                             {{ $tarea->fecha_finalizacion->format('d/m/Y') }}
                        </div>
                        @endif
                    @else
                        <span class="badge badge-pending">Pendiente</span>
                    @endif
                </td>
                <td>
                    <div class="actions">
                        @if(!$tarea->completada)
                            <a href="{{ route('tareas.edit', $tarea) }}" class="btn btn-secondary btn-sm">Editar</a>
                            <form action="{{ route('tareas.complete', $tarea) }}" method="POST" style="display:inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-primary btn-sm" style="background-color: var(--success); border:none;" onclick="return confirm('¿Marcar como completada?')">✓</button>
                            </form>
                            <form action="{{ route('tareas.destroy', $tarea) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar tarea?')">🗑</button>
                            </form>
                        @else
                            <span style="font-size: 0.875rem; color: var(--success); font-weight: 600;">Finalizada</span>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align: center; padding: 2rem; color: var(--text-muted);">No se encontraron tareas.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
