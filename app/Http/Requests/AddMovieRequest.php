<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddMovieRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'regex:/^[a-zA-Z\s]+$/', 'min:3', 'max:60'],
            'release_year' => [ 'required', 'integer', 'between:1900,' . date('Y')],
            'duration_minutes' => ['required', 'integer', 'min:60'],
            'plot_summary' => ['required', 'string']
        ];
    }
}
