<?php

namespace App\Dto\CommentDto;

class CommentUpdateDto
{
    public function __construct(
        public readonly ?string $body = null
    ){}
}