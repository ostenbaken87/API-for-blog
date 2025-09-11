<?php

namespace App\Dto\PostDto;

class PostUpdateDto
{
    public function __construct(
        public readonly ?string $title = null,
        public readonly ?string $status = null,
        public readonly ?string $body = null
    ){}
}