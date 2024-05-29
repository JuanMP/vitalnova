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
        $user->dni = $request->get('dni');
        $user->birthday = $request->get('birthday');
        $user->telephone = $request->get('telephone');
        $user->password = Hash::make($request->get('password'));

        if (auth()->check() && auth()->user()->isAdmin()) {
            $user->rol = $request->get('rol');
            $user->specialty = $request->get('specialty');
        } else {
            $user->rol = 'user';
        }

        $user->save();

        Auth::login($user);

        return redirect()->route('users.profile');
    }

    //Login para loguearse
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $rememberLogin = ($request->get('remember')) ? true : false;
        if (Auth::guard('web')->attempt($credentials, $rememberLogin)) {
            $request->session()->regenerate();
            return redirect()->route('index');
        } else {
            $error = 'Error al acceder a la aplicación';
            return view('auth.login', compact('error'));
        }
    }

    //Login entrar
    public function loginForm()
    {
        if (Auth::viaRemember()) {
            return 'Bienvenido de nuevo';
        } else if (Auth::check()) {
            return redirect()->route('users.profile');
        } else {
            return view('auth.login');
        }
    }

    //Logout para cerrar sesión
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('index');
    }
}
