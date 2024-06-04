<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use App\Models\Treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user) {
            if ($user->isDoctor()) {
                $appointments = Appointment::where('doctor_id', $user->id)->with('user', 'treatment')->get();
            } else if ($user->rol === 'receptionist') {
                $appointments = Appointment::with('user', 'treatment', 'doctor')->get();
            } else {
                $appointments = Appointment::where('user_id', $user->id)->with('doctor', 'treatment')->get();
            }

            return view('appointments.index', compact('appointments'));
        } else {
            //Redirigir a la página de inicio de sesión o mostrar un error
            return redirect()->route('login')->withErrors('Debe estar autenticado para ver las citas.');
        }
    }
    public function create(Request $request)
{
    $treatments = Treatment::all();
    $user_id = $request->get('user_id');
    $appointments = Appointment::all(); // Añadido para pasar las citas a la vista

    // Obtener la disponibilidad de doctores por tratamiento
    $doctorsAvailable = [];
    foreach ($treatments as $treatment) {
        $doctorsAvailable[$treatment->id] = User::whereHas('specialties', function ($query) use ($treatment) {
            $query->where('specialty_id', $treatment->specialty_id);
        })->exists();
    }

    return view('appointments.create', compact('treatments', 'user_id', 'appointments', 'doctorsAvailable'));
}



    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'email' => 'required|email',
            'telephone' => 'required|string|max:15',
            'observations' => 'nullable|string',
            'treatment_id' => 'required|exists:treatments,id',
            'user_id' => 'required|exists:users,id'
        ]);

        $treatment = Treatment::findOrFail($request->treatment_id);

        //Encuentra doctores con la especialidad del tratamiento
        $doctors = User::whereHas('specialties', function ($query) use ($treatment) {
            $query->where('specialty_id', $treatment->specialty_id);
        })->withCount('appointments')->get();

        //Encientra el doctor con menos citas
        $doctor = $doctors->sortBy('appointments_count')->first();

        //Si hay varios doctores con el mismo número de citas, seleccionar uno al azar
        $minAppointmentsCount = $doctor->appointments_count;
        $leastBusyDoctors = $doctors->filter(function ($doctor) use ($minAppointmentsCount) {
            return $doctor->appointments_count == $minAppointmentsCount;
        });

        if ($leastBusyDoctors->count() > 1) {
            $doctor = $leastBusyDoctors->random();
        }

        $appointment = new Appointment();
        $appointment->date = $request->get('date');
        $appointment->time = $request->get('time');
        $appointment->email = $request->get('email');
        $appointment->telephone = $request->get('telephone');
        $appointment->observations = $request->get('observations');
        $appointment->user_id = $request->input('user_id');
        $appointment->treatment_id = $request->get('treatment_id');
        $appointment->doctor_id = $doctor->id;
        $appointment->save();

        return redirect()->route('appointments.index')->with('success', 'Cita creada con éxito');
    }

    public function edit(Appointment $appointment)
    {
        $treatments = Treatment::all();
    $appointments = Appointment::all(); // Añadir esta línea para obtener todas las citas
    return view('appointments.edit', compact('appointment', 'treatments', 'appointments'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'email' => 'required|email',
            'telephone' => 'required|string|max:15',
            'observations' => 'nullable|string',
            'treatment_id' => 'required|exists:treatments,id',
        ]);

        $appointment->date = $request->get('date');
        $appointment->time = $request->get('time');
        $appointment->email = $request->get('email');
        $appointment->telephone = $request->get('telephone');
        $appointment->observations = $request->get('observations');
        $appointment->treatment_id = $request->get('treatment_id');
        $appointment->save();

        return redirect()->route('appointments.index')->with('success', 'Cita actualizada con éxito');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Cita eliminada con éxito');
    }
}
