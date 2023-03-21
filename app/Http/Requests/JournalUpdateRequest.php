<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JournalUpdateRequest extends FormRequest
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
            'volume' => 'nullable|string',
            'issue' => 'nullable|string',
            'year' => 'nullable|string',
            'month' => 'nullable|string',
            'issn' => 'nullable|string',
            'data.relationships.category.id' => 'nullable|exists:categories,id',

        ];
    }
}
