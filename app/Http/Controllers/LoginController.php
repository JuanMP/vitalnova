<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SignupRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //Login Probando en Laravel 11

    //Login
    public function signupForm()
    {
        return view('auth.signup');
    }

    //Registro
    public function signup(SignupRequest $request)
    {
        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->rol = 'user';
        $user->save();

        Auth::login($user);

        return redirect()->route('');
    }

    //Login para loguearse
    public function login(Request $request)
    {

    }

    //Login entrar
    public function loginForm()
    {

    }

    //Logout para cerrar sesión
    public function logout()
    {

    }

}
