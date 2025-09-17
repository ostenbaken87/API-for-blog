<?php

namespace App\Repositories\Comment;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

class CommentRepository implements CommentRepositoryInterface
{
    public function getUserCommentsOnActivePosts(int $userId): Collection
    {
        return Comment::where('user_id', $userId)
            ->whereHasMorph('commentable', [Post::class], function ($query) {
                $query->where('status', 'published');
            })
            ->with(['commentable', 'user'])
            ->get();
    }

    public function getCurrentUserComments(int $userId): Collection
    {
        return Comment::where('user_id', $userId)
            ->with(['commentable', 'user', 'replies'])
            ->get();
    }

    public function getPostComments(int $postId): Collection
    {
        return Comment::where('commentable_id', $postId)
            ->where('commentable_type', Post::class)
            ->with(['user', 'replies.user'])
            ->get();
    }

    public function getCommentReplies(int $commentId): Collection
    {
        return Comment::where('commentable_id', $commentId)
            ->where('commentable_type', Comment::class)
            ->with(['user', 'commentable'])
            ->get();
    }

    public function getCommentById(int $id): ?Comment
    {
        return Comment::with(['user', 'commentable', 'replies'])->find($id);
    }

    public function create(array $data): Comment
    {
        return Comment::create($data);
    }

    public function update(Comment $comment, array $data): Comment
    {
        $comment->update($data);
        return $comment->fresh();
    }

    public function delete(Comment $comment): bool
    {
        return $comment->delete();
    }
}