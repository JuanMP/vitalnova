<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class SpecialtyController extends Controller
{
    public function index()
    {
        $specialties = Specialty::all();
        return view('specialties.index', compact('specialties'));
    }

    public function create()
    {
        $doctors = User::where('rol', 'doctor')->get();
        return view('specialties.create', [
            'title' => 'Crear Especialidad',
            'action' => route('specialties.store'),
            'buttonText' => 'Crear',
            'specialty' => new Specialty(),
            'method' => 'POST',
            'doctors' => $doctors
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:specialties,name',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'doctors' => 'nullable|array',
            'doctors.*' => 'exists:users,id'
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
        if ($request->has('doctors')) {
            $specialty->users()->sync($request->doctors);
        }

        return redirect()->route('specialties.index')->with('success', 'Especialidad creada con éxito.');
    }

    public function edit(Specialty $specialty)
    {
        $doctors = User::where('rol', 'doctor')->get();
        return view('specialties.create', [
            'title' => 'Editar Especialidad',
            'action' => route('specialties.update', $specialty->id),
            'buttonText' => 'Actualizar',
            'specialty' => $specialty,
            'method' => 'PUT',
            'doctors' => $doctors,
            'selectedDoctors' => $specialty->users->pluck('id')->toArray()
        ]);
    }

    public function update(Request $request, Specialty $specialty)
    {
        $request->validate([
            'name' => 'required|string|unique:specialties,name,' . $specialty->id,
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'doctors' => 'nullable|array',
            'doctors.*' => 'exists:users,id'
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
        if ($request->has('doctors')) {
            $specialty->users()->sync($request->doctors);
        }

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
