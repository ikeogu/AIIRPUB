<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
/** @mixin App\Models\Editor */
class EditorResource extends JsonResource
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

            'type' => 'editor',
            'id' => intval($this->id),
            'attributes' => [
                'name' => $this->name,
                'title' => $this->title,
                'qualification' => $this->qualification,
                'employed_at' => $this->employed_at,
                'email' => $this->email,
                'number_of_publications' => $this->number_of_publications,
            ]

        ];
    }
}
