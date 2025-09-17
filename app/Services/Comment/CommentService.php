<?php

namespace App\Services\Comment;

use App\Models\Comment;
use App\Dto\CommentDto\CommentStoreDto;
use App\Dto\CommentDto\CommentUpdateDto;
use App\Repositories\Comment\CommentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CommentService implements CommentServiceInterface
{
    public function __construct(
        private CommentRepositoryInterface $commentRepository
    ) {}

    public function getUserCommentsOnActivePosts(int $userId): Collection
    {
        return $this->commentRepository->getUserCommentsOnActivePosts($userId);
    }

    public function getCurrentUserComments(int $userId): Collection
    {
        return $this->commentRepository->getCurrentUserComments($userId);
    }

    public function getPostComments(int $postId): Collection
    {
        return $this->commentRepository->getPostComments($postId);
    }

    public function getCommentReplies(int $commentId): Collection
    {
        return $this->commentRepository->getCommentReplies($commentId);
    }

    public function getCommentById(int $id): ?Comment
    {
        return $this->commentRepository->getCommentById($id);
    }

    public function createComment(CommentStoreDto $dto): Comment
    {
        $data = [
            'user_id' => $dto->userId,
            'body' => $dto->body,
            'commentable_id' => $dto->commentableId,
            'commentable_type' => $dto->commentableType
        ];

        return $this->commentRepository->create($data);
    }

    public function updateComment(Comment $comment, CommentUpdateDto $dto): Comment
    {
        $data = array_filter([
            'body' => $dto->body
        ], fn($value) => !is_null($value));

        return $this->commentRepository->update($comment, $data);
    }

    public function deleteComment(Comment $comment): bool
    {
        return $this->commentRepository->delete($comment);
    }
}