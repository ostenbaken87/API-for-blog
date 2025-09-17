<?php

namespace App\Services\Comment;

use App\Models\Comment;
use App\Dto\CommentDto\CommentStoreDto;
use App\Dto\CommentDto\CommentUpdateDto;
use Illuminate\Database\Eloquent\Collection;

interface CommentServiceInterface
{
    public function getUserCommentsOnActivePosts(int $userId): Collection;
    public function getCurrentUserComments(int $userId): Collection;
    public function getPostComments(int $postId): Collection;
    public function getCommentReplies(int $commentId): Collection;
    public function getCommentById(int $id): ?Comment;
    public function createComment(CommentStoreDto $dto): Comment;
    public function updateComment(Comment $comment, CommentUpdateDto $dto): Comment;
    public function deleteComment(Comment $comment): bool;
}