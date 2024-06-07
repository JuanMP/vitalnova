<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
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
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'email' => 'required|email',
            'telephone' => 'required|string|max:15',
            'observations' => 'nullable|string',
            'treatment_id' => 'required|exists:treatments,id',
            'user_id' => 'required|exists:users,id',
        ];
    }

    /**
     * Get the custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'date.required' => 'La fecha es obligatoria.',
            'date.date' => 'La fecha debe ser una fecha válida.',
            'date.after_or_equal' => 'La fecha debe ser hoy o una fecha futura.',
            'time.required' => 'La hora es obligatoria.',
            'time.date_format' => 'La hora debe estar en el formato HH:mm.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección de correo válida.',
            'email.max' => 'El correo electrónico no puede tener más de 50 caracteres.',
            'telephone.required' => 'El teléfono es obligatorio.',
            'telephone.string' => 'El teléfono debe ser una cadena de texto.',
            'telephone.max' => 'El teléfono no puede tener más de 15 caracteres.',
            'observations.string' => 'Las observaciones deben ser una cadena de texto.',
            'observations.max' => 'Las observaciones no pueden tener más de 255 caracteres.',
            'treatment_id.required' => 'El tratamiento es obligatorio.',
            'treatment_id.exists' => 'El tratamiento seleccionado no existe.',
            'user_id.required' => 'El ID del usuario es obligatorio.',
            'user_id.exists' => 'El usuario seleccionado no existe.',
        ];
    }
}
