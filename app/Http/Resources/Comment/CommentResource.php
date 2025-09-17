<?php

namespace App\Http\Resources\Comment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'body' => $this->body,
            'user_id' => $this->user_id,
            'user' => $this->whenLoaded('user', [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'email' => $this->user->email
            ]),
            'commentable_type' => $this->commentable_type,
            'commentable_id' => $this->commentable_id,
            'commentable' => $this->whenLoaded('commentable', function () {
                return [
                    'id' => $this->commentable->id,
                    'type' => class_basename($this->commentable)
                ];
            }),
            'replies' => CommentResource::collection($this->whenLoaded('replies')),
            'replies_count' => $this->replies_count ?? $this->replies->count(),
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
            'is_reply' => $this->isReply(),
            'is_post_comment' => $this->isPostComment()
        ];
    }
}