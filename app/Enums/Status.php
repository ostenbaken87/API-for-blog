<?php

namespace App\Enums;

enum Status: string
{
    case DRAFT = 'черновик';
    case PUBLISHED = 'опубликован';
    case ARCHIVED = 'архивирован';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}