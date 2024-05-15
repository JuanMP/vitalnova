<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */


     public function index()
{
    //Obtener todas las citas disponibles
    $appointments = Appointment::where('status', 'available')->get();
    
    //Retornar la vista index con las citas disponibles
    return view('appointments.index', compact('appointments'));
}

    public function create()
    {
        //Obtener todas las citas
        $allAppointments = Appointment::all();

        //Definir los intervalos de tiempo disponibles
        $availableTimes = ['09:00', '10:00', '11:00', '12:00', '13:00'];

        //Inicializar un array para almacenar los intervalos disponibles
        $availableSlots = [];

        //Iterar sobre los intervalos de tiempo disponibles
        foreach ($availableTimes as $time) {
            //Verificar si ya hay una cita reservada para este intervalo
            $existingAppointment = $allAppointments->firstWhere('hour', $time);

            //Determinar la disponibilidad del intervalo
            $available = !$existingAppointment;

            //Agregar el intervalo a la lista de disponibles
            $availableSlots[] = [
                'time' => $time,
                'available' => $available,
            ];
        }

        //Pasar los intervalos disponibles a la vista
        return view('appointments.create', compact('availableSlots'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Obtener la fecha y hora de la cita
        $date = $request->input('date');
        $hour = $request->input('hour');
        $dateTime = $date . ' ' . $hour;

        // Verificar si ya hay una cita reservada para esta fecha y hora
        $existingAppointment = Appointment::where('date', $date)
                                           ->where('hour', $hour)
                                           ->exists();

        if ($existingAppointment) {
            // Si ya hay una cita reservada, redirigir con un mensaje de error
            return redirect()->back()->with('error', '¡Lo sentimos! Esta cita ya está reservada.');
        } else {
            // Si la cita está disponible, guardarla en la base de datos
            $appointment = new Appointment();
            $appointment->name = $request->input('name');
            $appointment->email = $request->input('email');
            $appointment->telephone = $request->input('telephone');
            $appointment->date = $date;
            $appointment->hour = $hour;
            $appointment->status = 'reserved'; // Establecer el estado como reservado
            $appointment->commentary = $request->input('commentary');
            $appointment->save();

            // Redirigir a una vista de confirmación de cita o mostrar un mensaje de éxito
            return view('appointments.stored', compact('appointment'));
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
