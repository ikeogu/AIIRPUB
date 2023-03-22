<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin  \App\Models\SubmitArticle */
class SubmitArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'type' => 'submited_articles',
            'id' => $this->id,
            'attributes' => [
                'authors_name' => $this->authors_name,
                'authors_email' => $this->authors_email,
                'title_of_article' => $this->title_of_article,
                'country' => $this->country,
                'attachment' => $this->attachment,// @phpstan-ignore-line
                'status' => $this->status,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,

            ]

        ];
    }
}