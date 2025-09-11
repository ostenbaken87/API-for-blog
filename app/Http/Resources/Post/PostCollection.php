<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => PostResource::collection($this->collection),
            'count' => $this->collection->count(),
            'meta' => [
                'current_page' => 1,
                'total' => $this->collection->count(),
            ]
        ];
    }
}
