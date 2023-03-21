<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditorUpdateRequest extends FormRequest
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
            'name' => 'nullable|string',
            'title' => 'nullable|string',
            'qualification' => 'nullable|string',
            'employed_at' => 'nullable|string',
            'email' => 'nullable|email',
            'number_of_publications' => 'nullable|integer',

        ];
    }
}
