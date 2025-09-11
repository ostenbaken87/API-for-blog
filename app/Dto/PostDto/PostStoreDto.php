<?php

namespace App\Dto\PostDto;

class PostStoreDto
{
    public function __construct(
        public readonly string $title,
        public readonly string $status,
        public readonly int $userId,
        public readonly string $body
    ){}
}