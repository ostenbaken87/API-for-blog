<?php

namespace App\Dto\CommentDto;

class CommentStoreDto
{
    public function __construct(
        public readonly int $userId,
        public readonly string $body,
        public readonly int $commentableId,
        public readonly string $commentableType
    ){}
}