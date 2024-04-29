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
}
