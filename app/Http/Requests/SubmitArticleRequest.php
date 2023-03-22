<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmitArticleRequest extends FormRequest
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
            'authors_name'  => ['required', 'string', 'max:255'],
            'authors_email' => ['required', 'email', 'max:255', 'email'],
            'title_of_article' => ['required', 'string', 'max:255'],
            'country' => ['nullable', 'string'],
            'article' => ['nnullable', 'file', 'mimes:pdf,doc,docx'],
            'status' => ['nullable', 'string'],
        ];
    }

    public function messages() : array
    {
        return [
            'authors_name.required' => 'Authors name is required',
            'authors_email.required' => 'Authors email is required',
            'title_of_article.required' => 'Title of article is required',
            'article.required' => 'Article is required',
            'authors_name.max' => 'Authors name must not be more than 255 characters',
            'authors_email.max' => 'Authors email must not be more than 255 characters',
            'title_of_article.max' => 'Title of article must not be more than 255 characters',
            'article.mimes' => 'Article must be a file of type: pdf, doc, docx',
            'article.file' => 'Article must be a file of type: pdf, doc, docx',
        ];
    }
}