<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incident;

class IncidentController extends Controller
{
    public function getIndex()
    {
        $incidents = Incident::all();
        return view('incidents.index', compact('incidents'));
    }

    public function getShow($id)
    {
        $incident = Incident::findOrFail($id);
        return view('incidents.show', compact('incident'));
    }

    public function getCreate()
    {
        return view('incidents.create');
    }

    public function postCreate(Request $request)
    {
        $incident = new Incident();
        $incident->title = $request->title;
        $incident->description = $request->description;
        $incident->priority = $request->priority;
        $incident->user_id = auth()->id();
        $incident->save();

        return redirect('/incidents');
    }

    public function getEdit($id)
    {
        $incident = Incident::findOrFail($id);
        return view('incidents.edit', compact('incident'));
    }

    public function putEdit(Request $request, $id)
    {
        $incident = Incident::findOrFail($id);
        $incident->title = $request->title;
        $incident->description = $request->description;
        $incident->priority = $request->priority;
        
        // If status is sent (dropdown or checkbox)
        if ($request->has('status')) {
             $incident->status = $request->status;
        }
        
        $incident->save();

        return redirect('/incidents/show/' . $id);
    }

    public function putResolve($id) {
        $incident = Incident::findOrFail($id);
        $incident->status = true;
        $incident->save();
        return back();
    }
}
