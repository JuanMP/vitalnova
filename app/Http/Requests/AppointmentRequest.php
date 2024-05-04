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
            //
            'name' => 'required|string|max:20',
            'email' => 'required|email|max:20',
            'telephone' => 'required|string|max:9',
            'date' => 'required|date|after_or_equal:today',
            'hour' => 'required|date_format:H:i',
            'comentary' => 'nullable|string|max:255',
        ];
    }
}
