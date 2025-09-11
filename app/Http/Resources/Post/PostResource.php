<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'status' => $this->status,
            'user_id' => $this->user_id,
            'body' => $this->body,
            'created_at' => $this->created_at->format('H:i:s Y-m-d'),
            'updated_at' => $this->updated_at->format('H:i:s Y-m-d'),
        ];
    }
}
