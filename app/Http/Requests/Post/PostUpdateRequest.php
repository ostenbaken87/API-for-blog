<?php

namespace App\Http\Requests\Post;

use App\Enums\Status;
use App\Dto\PostDto\PostUpdateDto;
use Illuminate\Foundation\Http\FormRequest;

class PostUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'sometimes|string|min:3|max:255',
            'status' => 'sometimes|in:' . implode(',', Status::values()),
            'body' => 'sometimes|string',
        ];
    }

    public function toDto(): PostUpdateDto
    {
        return new PostUpdateDto(
            $this->title,
            $this->status ? Status::from($this->status)->value : null,
            $this->body
        );
    }
}
