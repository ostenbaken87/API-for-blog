<?php

namespace App\Repositories\Comment;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;

interface CommentRepositoryInterface
{
    public function getUserCommentsOnActivePosts(int $userId): Collection;
    public function getCurrentUserComments(int $userId): Collection;
    public function getPostComments(int $postId): Collection;
    public function getCommentReplies(int $commentId): Collection;
    public function getCommentById(int $id): ?Comment;
    public function create(array $data): Comment;
    public function update(Comment $comment, array $data): Comment;
    public function delete(Comment $comment): bool;
}