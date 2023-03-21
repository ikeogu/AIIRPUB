<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JournalRequest extends FormRequest
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
            'volume' => 'required|string',
            'issue' => 'nullable|string',
            'year' => 'required|string',
            'month' => 'required|string',
            'issn' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Journal name is required',
            'volume.required' => 'Journal volume is required',
            'year.required' => 'Journal year is required',
            'month.required' => 'Journal month is required',
            'data.relationships.category.id.required' => 'Journal category is required',
            'data.relationships.category.id.exists' => 'Journal category does not exist',
        ];
    }
}