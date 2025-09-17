<?php

namespace App\Http\Controllers\Api;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\Comment\CommentServiceInterface;
use App\Http\Requests\Comment\CommentStoreRequest;
use App\Http\Requests\Comment\CommentUpdateRequest;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct(
        private CommentServiceInterface $commentService
    ) {}

    // Все комментарии текущего пользователя
    public function index(): JsonResponse
    {
        $userId = Auth::id();
        $comments = $this->commentService->getCurrentUserComments($userId);
        
        return response()->json([
            'data' => $comments,
            'count' => $comments->count()
        ]);
    }

    // Комментарии пользователя к активным постам
    public function userCommentsOnActivePosts(int $userId): JsonResponse
    {
        $comments = $this->commentService->getUserCommentsOnActivePosts($userId);
        
        return response()->json([
            'data' => $comments,
            'count' => $comments->count()
        ]);
    }

    // Комментарии конкретного поста
    public function postComments(int $postId): JsonResponse
    {
        $comments = $this->commentService->getPostComments($postId);
        
        return response()->json([
            'data' => $comments,
            'count' => $comments->count()
        ]);
    }

    // Ответы на комментарий
    public function commentReplies(int $commentId): JsonResponse
    {
        $replies = $this->commentService->getCommentReplies($commentId);
        
        return response()->json([
            'data' => $replies,
            'count' => $replies->count()
        ]);
    }

    // Просмотр комментария
    public function show(int $id): JsonResponse
    {
        $comment = $this->commentService->getCommentById($id);
        
        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        return response()->json(['data' => $comment]);
    }

    // Создание комментария
    public function store(CommentStoreRequest $request): JsonResponse
    {
        $dto = $request->toDto();
        $comment = $this->commentService->createComment($dto);

        return response()->json([
            'message' => 'Comment created successfully',
            'data' => $comment
        ], 201);
    }

    // Обновление комментария
    public function update(CommentUpdateRequest $request, Comment $comment): JsonResponse
    {
        $dto = $request->toDto();
        $updatedComment = $this->commentService->updateComment($comment, $dto);

        return response()->json([
            'message' => 'Comment updated successfully',
            'data' => $updatedComment
        ]);
    }

    // Удаление комментария
    public function destroy(Comment $comment): JsonResponse
    {
        $this->commentService->deleteComment($comment);

        return response()->json([
            'message' => 'Comment deleted successfully'
        ]);
    }
}