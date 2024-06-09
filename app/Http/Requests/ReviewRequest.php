<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'review' => 'required|string',
            'score' => 'required|integer|min:1|max:5',
        ];
    }

    public function messages()
    {
        return [
            'review.required' => 'La reseña es obligatoria.',
            'review.string' => 'La reseña debe ser un texto válido.',
            'score.required' => 'La puntuación es obligatoria.',
            'score.integer' => 'La puntuación debe ser un número entero.',
            'score.min' => 'La puntuación mínima es 1.',
            'score.max' => 'La puntuación máxima es 5.',
        ];
    }

}
