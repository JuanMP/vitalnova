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
                $appointments = Appointment::where('user_id', $user->id)
                ->whereDate('date', '>=', Carbon::today())
                ->with('doctor', 'treatment')
                ->get();
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

        //Se obtiene el usuario especificado por el ID
        $user = User::find($user_id);

        //Añade para pasar las citas a la vista
        $appointments = Appointment::all();

        //Obtiene la disponibilidad de doctores por tratamiento
        $doctorsAvailable = [];
        foreach ($treatments as $treatment) {
            $doctorsAvailable[$treatment->id] = User::whereHas('specialties', function ($query) use ($treatment) {
                $query->where('specialty_id', $treatment->specialty_id);
            })->exists();
        }

        //Pasa los datos del usuario al formulario de creación de citas
        return view('appointments.create', compact('treatments', 'user', 'appointments', 'doctorsAvailable'));
    }




    public function store(AppointmentRequest $request)
{
    $treatment = Treatment::findOrFail($request->treatment_id);

    //Encuentra doctores con la especialidad del tratamiento
    $doctors = User::whereHas('specialties', function ($query) use ($treatment) {
        $query->where('specialty_id', $treatment->specialty_id);
    })->withCount('appointments')->get();

    //Encuentra el doctor con menos citas
    $doctor = $doctors->sortBy('appointments_count')->first();

    //Si hay varios doctores con el mismo número de citas, seleccionar uno al azar
    $minAppointmentsCount = $doctor->appointments_count;
    $leastBusyDoctors = $doctors->filter(function ($doctor) use ($minAppointmentsCount) {
        return $doctor->appointments_count == $minAppointmentsCount;
    });

    if ($leastBusyDoctors->count() > 1) {
        $doctor = $leastBusyDoctors->random();
    }

    //Obtén el usuario específico para la cita
    $user = User::findOrFail($request->user_id);

    $appointment = new Appointment();
    $appointment->date = $request->get('date');
    $appointment->time = $request->get('time');
    $appointment->email = $user->email; //Usa el email del usuario especificado
    $appointment->telephone = $user->telephone; //Usa el teléfono del usuario especificado
    $appointment->observations = $request->get('observations');
    $appointment->user_id = $user->id;
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
        //$request->validate([
        //    'date' => 'required|date',
        //    'time' => 'required|date_format:H:i',
        //    'email' => 'required|email',
        //    'telephone' => 'required|string|max:15',
        //    'observations' => 'nullable|string',
        //    'treatment_id' => 'required|exists:treatments,id',
        //]);

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
            $appointment->appointment_start = now()->addHours(2); //Establece la hora de inicio a la hora actual
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
            $appointment->appointment_end = now()->addHours(2); //Establece la hora de fin a la hora actual
            $appointment->save();
            return redirect()->route('appointments.index')->with('success', 'Cita finalizada con éxito.');
        }
        return redirect()->route('appointments.index')->with('error', 'No se puede finalizar la cita.');
    }

    public function historical()
    {
        $user = Auth::user();

        //Recuperar citas históricas del usuario autenticado
        $appointments = Appointment::where('user_id', $user->id)
                                    ->whereIn('status_id', [3, 5]) //Supongamos que el estado 3 es "finalizado"
                                    ->with('doctor', 'treatment')
                                    ->orderBy('date', 'desc')
                                    ->get();

        return view('appointments.historical', compact('appointments'));
    }
}
