<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Appointment;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function create(Appointment $appointment)
    {
        // Verificar si el usuario ya ha dejado una reseña para esta cita
        $existingReview = Review::where('appointment_id', $appointment->id)->first();
        if ($appointment->status_id != 3) {
            return redirect()->route('appointments.index')->with('error', 'No se puede valorar esta cita.');
        }

        if ($existingReview) {
            return redirect()->route('appointments.index')->with('error', 'Ya has valorado esta cita.');
        }

        return view('reviews.create', compact('appointment'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'review' => 'required|string',
            'score' => 'required|integer|min:1|max:5',
        ]);

        $review = new Review();
        $review->appointment_id = $request->appointment_id;
        $review->review = $request->review;
        $review->score = $request->score;
        $review->save();

        // Cambiar el estado de la cita a 5 (Finalizada Completa)
        $appointment = Appointment::findOrFail($request->appointment_id);
        $appointment->status_id = 5;
        $appointment->save();

        return redirect()->route('appointments.index')->with('success', 'Reseña guardada con éxito y cita completada.');
    }
}
