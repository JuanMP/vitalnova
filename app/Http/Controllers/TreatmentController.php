<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $treatments = Treatment::all();
        return view('treatments.index', compact('treatments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('treatments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
        ]);

        $treatment = new Treatment();
        $treatment->title = $request->get('title');
        $treatment->description = $request->get('description');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/treatments');
            $treatment->image = str_replace('public/', '/storage/', $imagePath);
        } else {
            $treatment->image = "/img/others/default-treatment.jpg";
        }

        $treatment->save();

        return redirect()->route('treatments.index')->with('success', 'Tratamiento añadido con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Treatment $treatment)
    {
        if (!auth()->check()) {
            return redirect()->route('loginForm');
        }

        return view('treatments.show', compact('treatment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Treatment $treatment)
    {
        return view('treatments.edit', compact('treatment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Treatment $treatment)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
        ]);

        $treatment->title = $request->get('title');
        $treatment->description = $request->get('description');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/treatments');
            $treatment->image = str_replace('public/', '/storage/', $imagePath);
        }

        $treatment->save();

        return redirect()->route('treatments.index')->with('success', 'Tratamiento actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Treatment $treatment)
    {
        $treatment->delete();
        return redirect()->route('treatments.index')->with('success', 'Tratamiento eliminado con éxito');
    }
}
