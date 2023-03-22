<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleRequest extends FormRequest
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
            'title' => 'nullable|string',
            'abstract' => 'nullable|string',
            'author_name' => 'nullable|string',
            'no_page' => 'nullable|string',
            'authors_email' => 'nullable|string',
            'keywords' => 'nullable|string',
            'other_authors_name' => 'nullable|array',
            'other_authors_email' => 'nullable|array',
            'published' => 'nullable|date',
            'attachement' => ['nullable','file', 'mimes:pdf,doc,docx'],
            'accepted' => 'nullable|date',
            'status' => 'nullable|boolean',
            'received' => 'nullable|date',
            'journal_id' => 'nullable|exists:journals,id',

        ];
    }
}
