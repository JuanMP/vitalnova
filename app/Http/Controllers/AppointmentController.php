<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentRequest;
use App\Models\Appointment;
use App\Models\User;
use App\Models\Treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user) {
            if ($user->isDoctor()) {
                $appointments = Appointment::where('doctor_id', $user->id)->whereDate('date', Carbon::today())->with('user', 'treatment')->get();
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
        $appointments = Appointment::all(); //Añadido para pasar las citas a la vista

        //Obtiene la disponibilidad de doctores por tratamiento
        $doctorsAvailable = [];
        foreach ($treatments as $treatment) {
            $doctorsAvailable[$treatment->id] = User::whereHas('specialties', function ($query) use ($treatment) {
                $query->where('specialty_id', $treatment->specialty_id);
            })->exists();
        }

        return view('appointments.create', compact('treatments', 'user_id', 'appointments', 'doctorsAvailable'));
    }



    public function store(AppointmentRequest $request)
    {
        // $request->validate([
        //     // 'date' => 'required|date',
        //     // 'time' => 'required|date_format:H:i',
        //     // 'email' => 'required|email',
        //     // 'telephone' => 'required|string|max:15',
        //     // 'observations' => 'nullable|string',
        //     // 'treatment_id' => 'required|exists:treatments,id',
        //     // 'user_id' => 'required|exists:users,id'
        // ]);

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
        $appointment->status_id = 1;

        $appointment->save();

        return redirect()->route('appointments.index')->with('success', 'Cita creada con éxito');
    }

    public function edit(Appointment $appointment)
    {
        $treatments = Treatment::all();
        $appointments = Appointment::all();
        return view('appointments.edit', compact('appointment', 'treatments', 'appointments'));
    }

    public function update(AppointmentRequest $request, Appointment $appointment)
    {
        // $request->validate([
        //     'date' => 'required|date',
        //     'time' => 'required|date_format:H:i',
        //     'email' => 'required|email',
        //     'telephone' => 'required|string|max:15',
        //     'observations' => 'nullable|string',
        //     'treatment_id' => 'required|exists:treatments,id',
        // ]);

        $appointment->date = $request->get('date');
        $appointment->time = $request->get('time');
        $appointment->email = $request->get('email');
        $appointment->telephone = $request->get('telephone');
        $appointment->observations = $request->get('observations');
        $appointment->treatment_id = $request->get('treatment_id');
        $appointment->save();

        return redirect()->route('appointments.index')->with('success', 'Cita actualizada con éxito');
    }


    public function show($id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('appointments.show', compact('appointment'));
    }


    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Cita eliminada con éxito');
    }

    //Función qe cambia el estado de la cita de 1 Pendiente a 2 En curso
    public function start($id)
    {
        $appointment = Appointment::findOrFail($id);
        if ($appointment->status_id == 1) { //Si el estado es 'Pendiente'
            $appointment->status_id = 2; //Cambia el estado a 'En curdo'
            $appointment->appointment_start = now(); //Establece la hora de inicio a la hora actual
            $appointment->save();
            return redirect()->route('appointments.index')->with('success', 'Cita iniciada con éxito.');
        }
        return redirect()->route('appointments.index')->with('error', 'No se puede iniciar la cita.');
    }


    //Funcion que cambia el estado de 2 En curso a 3 Finalizada
    public function finish($id)
    {
        $appointment = Appointment::findOrFail($id);
        if ($appointment->status_id == 2) { //Si el estado es 'En curso'
            $appointment->status_id = 3; //Cambiar el estado a 'Finalizada'
            $appointment->appointment_end = now(); //Establece la hora de fin a la hora actual
            $appointment->save();
            return redirect()->route('appointments.index')->with('success', 'Cita finalizada con éxito.');
        }
        return redirect()->route('appointments.index')->with('error', 'No se puede finalizar la cita.');
    }
}
