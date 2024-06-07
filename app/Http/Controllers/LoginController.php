<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\Specialty;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //Muestra el formulario de registro
    public function signupForm()
    {
        $specialties = Specialty::all(); //Obtiene todas las especialidades y las devuelve
        return view('auth.signup', compact('specialties'));
    }

    //Registra un nuevo usuario
    public function signup(UserRequest $request)
    {
        $currentUser = Auth::user(); //Guarda el usuario actual (puede ser admin o null)

        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->dni = $request->get('dni');
        $user->birthday = $request->get('birthday');
        $user->telephone = $request->get('telephone');
        $user->password = Hash::make($request->get('password'));
        $user->rol = $request->get('rol', 'user'); //Obtiene el rol del formulario, por defecto 'user'

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/profile_images');
            $user->image = str_replace('public/', '/storage/', $imagePath);
        } else {
            $user->image = '/img/others/user.jpg';
        }

        $user->save();

        //Asigna especialidades si el rol es doctor
        if ($user->rol == 'doctor' && $request->has('specialties')) {
            $user->specialties()->sync($request->get('specialties'));
        }

        //Si un admin está creando el usuario, restaura la sesión del admin
        if ($currentUser && $currentUser->rol == 'admin') {
            Auth::login($currentUser); //Restaura la sesión del administrador
            return redirect()->route('teams.index')->with('success', 'Usuario creado con éxito');
        }

        //Si es un registro normal, iniciar sesión con el nuevo usuario
        Auth::login($user);
        return redirect()->route('users.profile')->with('success', 'Registro exitoso');
    }

    //Login para loguearse
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $rememberLogin = $request->has('remember');
        if (Auth::attempt($credentials, $rememberLogin)) {
            $request->session()->regenerate();
            return redirect()->route('index');
        } else {
            $error = 'Usuario o contraseña incorrecto';
            return view('auth.login', compact('error'));
        }
    }

    //Muestra el formulario de login
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
