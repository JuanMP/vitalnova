<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:20',
            'email' => 'required|email|unique:users,email',
            'birthday' => 'required|date|before_or_equal:today|after:-100 years|before:-14 years',
            'dni' => ['required', 'string', 'size:9', 'unique:users,dni', 'regex:/^[0-9]{8}[A-Za-z]$/'],
            'telephone' => ['required', 'string', 'regex:/^[6|7|9][0-9]{8}$/'],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*]).{8,}$/'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Debes introducir un nombre.',
            'name.min' => 'El nombre debe tener al menos 2 caracteres.',
            'name.max' => 'El nombre no puede tener más de 20 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debes introducir un correo electrónico válido.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
            'birthday.required' => 'La fecha de nacimiento es obligatoria.',
            'birthday.date' => 'Debes elegir una fecha válida.',
            'birthday.before_or_equal' => 'La fecha de nacimiento debe ser anterior o igual a hoy.',
            'birthday.after' => 'La fecha de nacimiento debe ser posterior a hace 100 años.',
            'birthday.before' => 'Debes tener al menos 14 años para registrarte.',
            'dni.required' => 'El DNI es obligatorio.',
            'dni.string' => 'El DNI debe ser una cadena de caracteres.',
            'dni.size' => 'El DNI debe tener 9 caracteres.',
            'dni.unique' => 'Este DNI ya está registrado.',
            'dni.regex' => 'El DNI debe tener 8 números seguidos de una letra.',
            'telephone.required' => 'El teléfono es obligatorio.',
            'telephone.string' => 'El teléfono debe ser una cadena de caracteres.',
            'telephone.regex' => 'El teléfono debe ser un número válido de España.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.string' => 'La contraseña debe ser una cadena de caracteres.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.regex' => 'La contraseña debe contener al menos una letra, un número y un carácter especial.',
        ];
    }
}
