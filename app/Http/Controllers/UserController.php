<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;

class UserController extends Controller
{
    //Devuelve la vista del perfil del usuario al hacer login
    public function show()
    {
        $user = auth()->user();
        return view('users.profile', compact('user'));
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
        $user->save();

        return redirect()->route('users.profile');
    }
}
