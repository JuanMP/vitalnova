<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SignupRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //Muestra el formulario de registro
    public function signupForm()
    {
        return view('auth.signup');
    }

    //Registro de usuarios
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

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/users');
            $user->image = str_replace('public/', '/storage/', $imagePath);
        } else {
            $user->image = '/img/others/user.jpg';
        }

        $user->save();

        Auth::login($user);

        return redirect()->route('users.profile');
    }

    //Inicio de sesión
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

    // Muestra el formulario de login
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

    //Cierra la sesión del usuario
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('index');
    }
}
