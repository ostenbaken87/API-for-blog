<?php

namespace App\Http\Requests\Comment;

use App\Dto\CommentDto\CommentUpdateDto;
use Illuminate\Foundation\Http\FormRequest;

class CommentUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'body' => 'sometimes|string|min:1|max:1000'
        ];
    }

    public function toDto(): CommentUpdateDto
    {
        return new CommentUpdateDto(
            $this->body
        );
    }
}