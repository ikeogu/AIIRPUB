<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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

            'title' => 'required|string',
            'abstract' => 'required|string',
            'authors_name' => 'required|string',
            'no_page' => 'required|string',
            'authors_email' => 'required|string',
            'keywords' => 'required|string',
            'other_authors_name' => 'required|array',
            'other_authors_email' => 'required|array',
            'attachment' =>['required', 'file', 'mimes:pdf,doc,docx'],
            'accepted' => 'required|date',
            'status' => 'required|boolean',
            'received' => 'required|date',
            'journal_id' => 'required|exists:journals,id',

        ];
    }
}