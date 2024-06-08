<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Dompdf\Dompdf;
use Dompdf\Options;

class DocumentController extends Controller
{
    public function generateAppointmentDocument($appointmentId)
    {
        $appointment = Appointment::with(['doctor', 'treatment', 'user'])->findOrFail($appointmentId);

        //Convierte la imagen a Base64
        $logoPath = public_path('img/others/logo.png');
        $logoData = base64_encode(file_get_contents($logoPath));
        $logoSrc = 'data:image/png;base64,' . $logoData;

        $options = new Options();
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);

        //Pasa la imagen codificada en Base64 a la vista
        $view = view('pdf.appointment', compact('appointment', 'logoSrc'))->render();

        $dompdf->loadHtml($view);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $dompdf->stream('Justificante_Cita_' . $appointment->id . '.pdf');
    }
}
