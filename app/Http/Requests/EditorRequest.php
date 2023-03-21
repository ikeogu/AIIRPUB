<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            'name' => 'required|string',
            'title' => 'required|string',
            'qualification' => 'required|string',
            'employed_at' => 'required|string',
            'email' => 'required|email',
            'number_of_publications' => 'required|integer',

        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, mixed>
     */

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required',
            'title.required' => 'Title is required',
            'qualification.required' => 'Qualification is required',
            'employed_at.required' => 'Employed at is required',
            'email.required' => 'Email is required',
            'number_of_publications.required' => 'Number of publications is required',
        ];
    }
}
