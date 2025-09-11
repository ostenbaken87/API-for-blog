<?php

namespace App\Http\Requests\Post;

use App\Enums\Status;
use App\Dto\PostDto\PostStoreDto;
use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
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
            'title' => 'required|string|min:3|max:255',
            'status' => 'sometimes|in:' . implode(',', Status::values()),
            'body' => 'required|string',
        ];
    }

    public function toDto(): PostStoreDto
    {
        return new PostStoreDto(
            $this->title,
            Status::DRAFT->value,
            $this->user()->id,
            $this->body
        );
    }
}
