<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TareaController extends Controller
{
    public function index(Request $request)
    {
        $query = Tarea::with(['creador', 'modificador', 'completador']);

        if ($request->filled('termino')) {
            $term = $request->input('termino');
            $query->where(function($q) use ($term) {
                $q->where('nombre', 'like', "%{$term}%")
                  ->orWhere('descripcion', 'like', "%{$term}%");
            });
        }

        if ($request->filled('estado')) {
            $query->where('completada', $request->input('estado'));
        }

        if ($request->filled('fecha_desde')) {
            $query->whereDate('created_at', '>=', $request->input('fecha_desde'));
        }

        if ($request->filled('fecha_hasta')) {
            $query->whereDate('created_at', '<=', $request->input('fecha_hasta'));
        }

        $tareas = $query->orderBy('created_at', 'desc')->get();

        return view('tareas.index', compact('tareas'));
    }

    public function create()
    {
        return view('tareas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'required',
        ]);

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

    public function update(Request $request, Tarea $tarea)
    {
        $validated = $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'required',
        ]);

        $tarea->update([
            'nombre' => $validated['nombre'],
            'descripcion' => $validated['descripcion'],
            'id_usr_mod' => Auth::id(),
        ]);

        return redirect()->route('tareas.index')->with('success', 'Tarea actualizada correctamente');
    }

    public function destroy(Tarea $tarea)
    {
        if ($tarea->completada) {
            return back()->with('error', 'No se puede eliminar una tarea completada');
        }

        $tarea->delete();

        return redirect()->route('tareas.index')->with('success', 'Tarea eliminada correctamente');
    }

    public function complete(Tarea $tarea)
    {
        $tarea->update([
            'completada' => true,
            'fecha_finalizacion' => now(),
            'id_usr_comp' => Auth::id(),
        ]);

        return back()->with('success', 'Tarea marcada como completada');
    }
}
