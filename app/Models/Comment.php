<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'user_id',
        'commentable_id',
        'commentable_type'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function replies(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function isReply(): bool
    {
        return $this->commentable_type === self::class;
    }

    public function isPostComment(): bool
    {
        return $this->commentable_type === Post::class;
    }
}
