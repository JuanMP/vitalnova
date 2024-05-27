<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Specialist;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRol('user')) {
            $appointments = Appointment::where('user_id', Auth::id())->get();
        } else {
            $appointments = Appointment::all();
        }

        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        $specialists = Specialist::all();
        $doctors = Doctor::all();
        $appointments = Appointment::all();
        return view('appointments.create', compact('specialists', 'doctors', 'appointments'));
    }

    public function store(Request $request)
    {
        //Valida los datos del formulario
        $request->validate([
            'date' => 'required|date',
            'time' => 'required',
            'email' => 'required|email',
            'telephone' => 'required',
            'specialist_id' => 'required|exists:specialists,id',
            'doctor_id' => 'required|exists:doctors,id',
        ]);

        //Crea una nueva instancia de Appointment y asigna los valores del formulario
        $appointment = new Appointment();
        $appointment->user_id = Auth::id(); // Obtiene el ID del usuario autenticado
        $appointment->date = $request->input('date');
        $appointment->time = $request->input('time');
        $appointment->email = $request->input('email');
        $appointment->telephone = $request->input('telephone');
        $appointment->comentario = $request->input('comentario');
        $appointment->specialist_id = $request->input('specialist_id');
        $appointment->doctor_id = $request->input('doctor_id');

        //Guarda la cita en la base de datos
        $appointment->save();

        //Redirige al usuario con un mensaje de éxito
        return redirect()->route('appointments.index')->with('success', 'Cita creada con éxito!');
    }

    //Función para eliminar cita
    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return redirect()->route('appointments.index')->with('success', 'La cita se ha eliminado satisfactoriamente');
    }
}
