<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FilmResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'link' => $this->link,
            'publisher' => $this->publisher,
            'release_date' => $this->release_date,
            'category' => [
                'id' => $this->category->id ?? null,
                'name' => $this->category->name ?? null,
            ],
            'created_at' => $this->created_at,
        ];   
    }

    public function with(Request $request): array
    {
        return [
            'status' => 'success',
            'msg' => 'request successful',
        ];
    }
}
