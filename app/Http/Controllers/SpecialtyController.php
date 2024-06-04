<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SpecialtyController extends Controller
{
    public function index()
    {
        $specialties = Specialty::all();
        return view('specialties.index', compact('specialties'));
    }

    public function create()
    {
        return view('specialties.create', [
            'title' => 'Crear Especialidad',
            'action' => route('specialties.store'),
            'buttonText' => 'Crear',
            'specialty' => new Specialty(),
            'method' => 'POST'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:specialties,name',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string'
        ]);

        $specialty = new Specialty();
        $specialty->name = $request->name;
        $specialty->description = $request->description;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/specialties');
            $specialty->image = str_replace('public/', '/storage/', $imagePath);
        } else {
            $specialty->image = '/img/others/default.jpg';
        }

        $specialty->save();

        return redirect()->route('specialties.index')->with('success', 'Especialidad creada con éxito.');
    }

    public function edit(Specialty $specialty)
    {
        return view('specialties.create', [
            'title' => 'Editar Especialidad',
            'action' => route('specialties.update', $specialty->id),
            'buttonText' => 'Actualizar',
            'specialty' => $specialty,
            'method' => 'PUT'
        ]);
    }

    public function update(Request $request, Specialty $specialty)
    {
        $request->validate([
            'name' => 'required|string|unique:specialties,name,' . $specialty->id,
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string'
        ]);

        $specialty->name = $request->name;
        $specialty->description = $request->description;

        if ($request->hasFile('image')) {
            // Eliminar la imagen antigua si existe
            if ($specialty->image && $specialty->image != '/img/others/default.jpg') {
                Storage::delete(str_replace('/storage/', 'public/', $specialty->image));
            }
            $imagePath = $request->file('image')->store('public/specialties');
            $specialty->image = str_replace('public/', '/storage/', $imagePath);
        }

        $specialty->save();

        return redirect()->route('specialties.index')->with('success', 'Especialidad actualizada con éxito.');
    }

    public function destroy(Specialty $specialty)
    {
        if ($specialty->image && $specialty->image != '/img/others/default.jpg') {
            Storage::delete(str_replace('/storage/', 'public/', $specialty->image));
        }
        $specialty->delete();
        return redirect()->route('specialties.index')->with('success', 'Especialidad eliminada con éxito.');
    }
}
