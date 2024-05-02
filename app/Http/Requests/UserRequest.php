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
            //
            'name' => 'required|string|min:2|max:20',
            'birthday' => 'required|date|before_or_equal:today|after: -100 years|before: -14 years',
            'dni' => 'required|string|size:9|unique:users,dni',
            'telephone' => 'required|string|max:15',
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'Debes introducir un nuevo nombre',
            'name.min' => 'El nombre debe tener mínimo 2 carácteres',
            'name.max' => 'El nombre no puede tener más de 20 carácteres',
            'birthday.required' => 'La fecha de nacimiento es obligatoria',
            'birthday.date' => 'Debes elegir una fecha válida',
            'birthday.after' => 'Ha habido un error, introduce una fecha válida',
            'birthday.before' => 'Debes tener al menos 14 años para poder registrarte',
            'dni.required' => 'El DNI es obligatorio',
            'dni.string' => 'El DNI debe ser una cadena de caracteres',
            'dni.size' => 'El DNI debe tener 9 caracteres',
            'dni.unique' => 'Este DNI ya está registrado',
            'telephone.required' => 'El teléfono es obligatorio',
            'telephone.string' => 'El teléfono debe ser una cadena de caracteres',
            'telephone.max' => 'El teléfono no puede tener más de 15 caracteres',
        ];
    }
}
