<?php

namespace App\Http\Requests\Comment;

use App\Dto\CommentDto\CommentStoreDto;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CommentStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'body' => 'required|string|min:1|max:1000',
            'commentable_id' => 'required|integer',
            'commentable_type' => [
                'required',
                'string',
                Rule::in([Post::class, Comment::class])
            ]
        ];
    }

    public function toDto(): CommentStoreDto
    {
        return new CommentStoreDto(
            $this->user()->id,
            $this->body,
            $this->commentable_id,
            $this->commentable_type
        );
    }
}