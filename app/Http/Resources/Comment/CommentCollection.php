<?php

namespace App\Http\Resources\Comment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CommentCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'data' => CommentResource::collection($this->collection),
            'count' => $this->collection->count(),
            'meta' => [
                'current_page' => 1,
                'total' => $this->collection->count(),
            ]
        ];
    }
}