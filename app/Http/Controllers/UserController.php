<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\Appointment;

class UserController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        $appointments = Appointment::where('user_id', $user->id)->get(); //Obtiene las citas del usuario autenticado

        return view('users.profile', compact('user', 'appointments')); //Pasa las citas a la vista
    }

    public function edit(User $user)
    {
        $user = auth()->user();
        return view('users.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {
        $user->name = $request->input('name');
        $user->birthday = $request->input('birthday');
        $user->dni = $request->input('dni');
        $user->telephone = $request->input('telephone');
        $user->save();

        return redirect()->route('users.profile');
    }
}
