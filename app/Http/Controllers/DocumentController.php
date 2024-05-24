<?php
// app/Http/Controllers/DocumentController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use \Barryvdh\DomPDF\Facade\Pdf;


class DocumentController extends Controller
{
    public function generateAppointmentDocument($appointmentId)
    {
        $appointment = Appointment::findOrFail($appointmentId);

        $data = [
            'date' => $appointment->date,
            'time' => $appointment->time,
            'specialist' => $appointment->specialist,
            'comentario' => $appointment->comentario,
            'user' => $appointment->user
        ];

        $pdf = PDF::loadView('pdf.appointment', $data);

        return $pdf->download('appointment.pdf');
    }
}
