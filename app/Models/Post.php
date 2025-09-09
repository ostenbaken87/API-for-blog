<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'status',
        'user_id',
    ];

    protected $casts = [
        'status' => Status::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function isActive(): bool
    {
        return $this->status === Status::PUBLISHED->value;
    }

    public function isArchived(): bool
    {
        return $this->status === Status::ARCHIVED->value;
    }

    public function isDraft(): bool
    {
        return $this->status === Status::DRAFT->value;
    }

    public function scopeActive($query)
    {
        return $query->where('status', Status::PUBLISHED->value);
    }

    public function scopeArchived($query)
    {
        return $query->where('status', Status::ARCHIVED->value);
    }

    public function scopeDraft($query)
    {
        return $query->where('status', Status::DRAFT->value);
    }
}
