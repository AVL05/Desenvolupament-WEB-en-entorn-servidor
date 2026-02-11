<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TareaController extends Controller
{
    // Listado de tareas con filtros
    public function index(Request $request)
    {
        // Cargamos las relaciones para optimizar consultas (Eager Loading)
        $query = Tarea::with(['creador', 'modificador', 'completador']);

        // Filtro por término de búsqueda (nombre o descripción)
        if ($request->filled('termino')) {
            $term = $request->input('termino');
            $query->where(function($q) use ($term) {
                $q->where('nombre', 'like', "%{$term}%")
                  ->orWhere('descripcion', 'like', "%{$term}%");
            });
        }

        // Filtro por estado (completada o pendiente)
        if ($request->filled('estado')) {
            $query->where('completada', $request->input('estado'));
        }

        // Filtro por rango de fechas de creación
        if ($request->filled('fecha_desde')) {
            $query->whereDate('created_at', '>=', $request->input('fecha_desde'));
        }

        if ($request->filled('fecha_hasta')) {
            $query->whereDate('created_at', '<=', $request->input('fecha_hasta'));
        }

        // Obtenemos los resultados ordenados por fecha de creación descendente
        $tareas = $query->orderBy('created_at', 'desc')->get();

        return view('tareas.index', compact('tareas'));
    }

    public function create()
    {
        return view('tareas.create');
    }

    // Almacena una nueva tarea en la base de datos
    public function store(Request $request)
    {
        // Validamos los datos del formulario
        $validated = $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'required',
        ]);

        // Creamos la tarea asignando el usuario actual como creador
        Tarea::create([
            'nombre' => $validated['nombre'],
            'descripcion' => $validated['descripcion'],
            'id_usr_crea' => Auth::id(),
        ]);

        return redirect()->route('tareas.index')->with('success', 'Tarea creada correctamente');
    }

    public function edit(Tarea $tarea)
    {
        return view('tareas.edit', compact('tarea'));
    }

    // Actualiza una tarea existente
    public function update(Request $request, Tarea $tarea)
    {
        $validated = $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'required',
        ]);

        // Actualizamos los datos y registramos quién hizo la modificación
        $tarea->update([
            'nombre' => $validated['nombre'],
            'descripcion' => $validated['descripcion'],
            'id_usr_mod' => Auth::id(),
        ]);

        return redirect()->route('tareas.index')->with('success', 'Tarea actualizada correctamente');
    }

    // Elimina una tarea
    public function destroy(Tarea $tarea)
    {
        // Validación lógica: no permitimos borrar tareas ya completadas
        if ($tarea->completada) {
            return back()->with('error', 'No se puede eliminar una tarea completada');
        }

        $tarea->delete();

        return redirect()->route('tareas.index')->with('success', 'Tarea eliminada correctamente');
    }

    // Marca una tarea como completada
    public function complete(Tarea $tarea)
    {
        // Actualizamos estado, fecha y usuario que completó
        $tarea->update([
            'completada' => true,
            'fecha_finalizacion' => now(),
            'id_usr_comp' => Auth::id(),
        ]);

        return back()->with('success', 'Tarea marcada como completada');
    }
}
