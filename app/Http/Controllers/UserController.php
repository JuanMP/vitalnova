<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\Appointment;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        $appointments = Appointment::where('user_id', $user->id)->get();

        return view('users.profile', compact('user', 'appointments'));
    }

    public function edit()
    {
        $user = auth()->user();
        return view('users.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'dni' => 'required|string|max:255',
            'telephone' => 'required|string|max:255',
            'birthday' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->birthday = $request->input('birthday');
        $user->dni = $request->input('dni');
        $user->telephone = $request->input('telephone');

        if ($request->hasFile('image')) {
            //Elimina la imagen anterior si existe
            if ($user->image && Storage::exists('public/' . $user->image)) {
                Storage::delete('public/' . $user->image);
            }
            $imagePath = $request->file('image')->store('public/profile_images');
            $user->image = str_replace('public/', '/storage/', $imagePath);
        }

        $user->save();

        return redirect()->route('users.profile')->with('success', 'Perfil actualizado con éxito');
    }
}
