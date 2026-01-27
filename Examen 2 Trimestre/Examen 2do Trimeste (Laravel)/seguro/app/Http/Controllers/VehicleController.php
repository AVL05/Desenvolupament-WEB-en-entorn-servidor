<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class VehicleController extends Controller
{
    public function index(Request $request): View
    {
        $query = DB::table('vehiculo');

        if ($request->has('matricula') && $request->input('matricula') !== null) {
            $query->where('matricula', 'like', '%' . $request->input('matricula') . '%');
        }

        $vehicles = $query->get();

        return view('vehicles.index', ['vehicles' => $vehicles]);
    }

    public function create(): View
    {
        return view('vehicles.create');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'matricula' => 'required|unique:vehiculo,matricula',
            'marca' => 'required',
            'modelo' => 'required',
            'anyo_fab' => 'required|integer',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('vehicles', 'public');
            $fotoPath = 'storage/' . $path;
        }

        DB::table('vehiculo')->insert([
            'matricula' => $validated['matricula'],
            'marca' => $validated['marca'],
            'modelo' => $validated['modelo'],
            'anyo_fab' => $validated['anyo_fab'],
            'foto' => $fotoPath,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('vehicles.index')->with('success', 'Vehículo creado correctamente.');
    }

    public function edit($id): View
    {
        $vehicle = DB::table('vehiculo')->where('id', $id)->first();
        if (!$vehicle) {
            abort(404);
        }
        return view('vehicles.edit', ['vehicle' => $vehicle]);
    }

    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'matricula' => 'required|unique:vehiculo,matricula,' . $id,
            'marca' => 'required',
            'modelo' => 'required',
            'anyo_fab' => 'required|integer',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $vehicle = DB::table('vehiculo')->where('id', $id)->first();
        $fotoPath = $vehicle->foto;

        if ($request->hasFile('foto')) {
            if ($vehicle->foto && strpos($vehicle->foto, 'http') === false) {
                 $oldPath = str_replace('storage/', '', $vehicle->foto);
                 \Illuminate\Support\Facades\Storage::disk('public')->delete($oldPath);
            }

            $path = $request->file('foto')->store('vehicles', 'public');
            $fotoPath = 'storage/' . $path;
        }

        DB::table('vehiculo')->where('id', $id)->update([
            'matricula' => $validated['matricula'],
            'marca' => $validated['marca'],
            'modelo' => $validated['modelo'],
            'anyo_fab' => $validated['anyo_fab'],
            'foto' => $fotoPath,
            'updated_at' => now(),
        ]);

        return redirect()->route('vehicles.index')->with('success', 'Vehículo actualizado correctamente.');
    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $vehicle = DB::table('vehiculo')->where('id', $id)->first();

        if ($vehicle) {
            if ($vehicle->foto && strpos($vehicle->foto, 'http') === false) {
                 $oldPath = str_replace('storage/', '', $vehicle->foto);
                 \Illuminate\Support\Facades\Storage::disk('public')->delete($oldPath);
            }
            
            DB::table('vehiculo')->where('id', $id)->delete();
        }

        return redirect()->route('vehicles.index')->with('success', 'Vehículo eliminado correctamente.');
    }
}
