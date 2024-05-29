<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use App\Models\User;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    public function index()
    {
        $treatments = Treatment::with('doctor')->get();
        return view('treatments.index', compact('treatments'));
    }

    public function create()
    {
        $doctors = User::where('rol', 'doctor')->get();
        return view('treatments.create', compact('doctors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
            'cost' => 'required|numeric',
            'doctor_id' => 'required|exists:users,id',
        ]);

        $treatment = new Treatment();
        $treatment->title = $request->get('title');
        $treatment->description = $request->get('description');
        $treatment->cost = $request->get('cost');
        $treatment->doctor_id = $request->get('doctor_id');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/treatments');
            $treatment->image = str_replace('public/', '/storage/', $imagePath);
        } else {
            $treatment->image = "/img/others/default-treatment.jpg";
        }

        $treatment->save();

        return redirect()->route('treatments.index')->with('success', 'Tratamiento añadido con éxito');
    }

    public function edit(Treatment $treatment)
    {
        $doctors = User::where('rol', 'doctor')->get();
        return view('treatments.edit', compact('treatment', 'doctors'));
    }

    public function update(Request $request, Treatment $treatment)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
            'cost' => 'required|numeric',
            'doctor_id' => 'required|exists:users,id',
        ]);

        $treatment->title = $request->get('title');
        $treatment->description = $request->get('description');
        $treatment->cost = $request->get('cost');
        $treatment->doctor_id = $request->get('doctor_id');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/treatments');
            $treatment->image = str_replace('public/', '/storage/', $imagePath);
        }

        $treatment->save();

        return redirect()->route('treatments.index')->with('success', 'Tratamiento actualizado con éxito');
    }

    public function destroy(Treatment $treatment)
    {
        $treatment->delete();
        return redirect()->route('treatments.index')->with('success', 'Tratamiento eliminado con éxito');
    }
}
