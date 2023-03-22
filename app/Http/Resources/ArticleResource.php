<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin  \App\Models\Article */
class ArticleResource extends JsonResource
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
            'id' => intval($this->id),
            'type' => 'published article',
            'attributes' => [
                'title' => $this->title,
                'abstract' => $this->abstract,
                'author_name' => $this->authors_name,
                'no_page' => $this->no_page,
                'authors_email' => $this->authors_email,
                'keywords' => $this->keywords,
                'authors_name' => $this->authors_name,
                'published' => $this->created_at?->format('d-m-Y'),
                'attachement' => $this->attachment,
                'accepted' => $this->accepted,
                'status' => $this->status,
                'received' => $this->received,
                'slug' => $this->slug,

            ],
            'relationships' => [
                'journal' => [
                    'data' => [
                        'id' => $this->journal?->id,
                        'type' => 'journal',
                        'attributes' => [
                            'name' => $this->journal?->name,
                            'volume' => $this->journal?->volume,
                        ],
                        'relationships' => [
                            'category' => [
                                'data' => [
                                    'id' => $this->journal?->category?->id,
                                    'type' => 'category',
                                    'attributes' => [
                                        'name' => $this->journal?->category?->name,
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }
}