<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PolizaController extends Controller
{
    public function index(): View
    {
        $polizas = DB::table('poliza')
            ->join('vehiculo', 'poliza.id_vehiculo', '=', 'vehiculo.id')
            ->select('poliza.*', 'vehiculo.matricula', 'vehiculo.marca', 'vehiculo.modelo')
            ->get();

        return view('polizas.index', ['polizas' => $polizas]);
    }

    public function create(): View
    {
        $vehiculos = DB::table('vehiculo')->select('id', 'matricula', 'marca', 'modelo')->get();
        return view('polizas.create', ['vehiculos' => $vehiculos]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'id_vehiculo' => 'required|exists:vehiculo,id',
            'tipo' => 'required|string|in:Todo Riesgo,Terceros',
            'importe' => 'required|numeric',
            'fecha_comienzo' => 'required|date',
            'fecha_renovacion' => 'required|date|after:fecha_comienzo',
        ]);

        DB::table('poliza')->insert([
            'id_vehiculo' => $validated['id_vehiculo'],
            'tipo' => $validated['tipo'],
            'importe' => $validated['importe'],
            'fecha_comienzo' => $validated['fecha_comienzo'],
            'fecha_renovacion' => $validated['fecha_renovacion'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('polizas.index')->with('success', 'Póliza creada correctamente.');
    }

    public function edit($id): View
    {
        $poliza = DB::table('poliza')->where('id', $id)->first();
        if (!$poliza) {
            abort(404);
        }

        $vehiculos = DB::table('vehiculo')->select('id', 'matricula', 'marca', 'modelo')->get();

        return view('polizas.edit', ['poliza' => $poliza, 'vehiculos' => $vehiculos]);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $validated = $request->validate([
            'id_vehiculo' => 'required|exists:vehiculo,id',
            'tipo' => 'required|string|in:Todo Riesgo,Terceros',
            'importe' => 'required|numeric',
            'fecha_comienzo' => 'required|date',
            'fecha_renovacion' => 'required|date|after:fecha_comienzo',
        ]);

        DB::table('poliza')->where('id', $id)->update([
            'id_vehiculo' => $validated['id_vehiculo'],
            'tipo' => $validated['tipo'],
            'importe' => $validated['importe'],
            'fecha_comienzo' => $validated['fecha_comienzo'],
            'fecha_renovacion' => $validated['fecha_renovacion'],
            'updated_at' => now(),
        ]);

        return redirect()->route('polizas.index')->with('success', 'Póliza actualizada correctamente.');
    }

    public function destroy($id): RedirectResponse
    {
        DB::table('poliza')->where('id', $id)->delete();
        return redirect()->route('polizas.index')->with('success', 'Póliza eliminada correctamente.');
    }
}
