<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        $data = [
            'movements' => $this->movements()->orderBy('created_at', 'desc')->limit(5)->get(),
        ];

        return array_merge(parent::toArray($request), $data);
    }
}
