<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Post\PostCollection;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Post\PostResource;
use App\Services\Post\PostServiceInterface;
use App\Http\Requests\Post\PostStoreRequest;
use App\Http\Requests\Post\PostUpdateRequest;

class PostController extends Controller
{
    public function __construct(
        private PostServiceInterface $postService
    ) {
    }

    public function index(): PostCollection
    {
        $userId = Auth::id();
        $posts = $this->postService->getAllPostsByUser($userId);

        return new PostCollection($posts);
    }

    public function published(): PostCollection
    {
        $userId = Auth::id();
        $posts = $this->postService->getPublishedPosts($userId);

        return new PostCollection($posts);
    }

    public function show(int $id): JsonResponse
    {
        $post = $this->postService->getPostById($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        return response()->json(['data' => $post]);
    }

    public function store(PostStoreRequest $request): PostResource
    {
        $dto = $request->toDto();
        $post = $this->postService->createPost($dto->userId, $dto);

        return new PostResource($post);
    }

    public function update(PostUpdateRequest $request, Post $post): PostResource
    {
        $dto = $request->toDto();
        $updatedPost = $this->postService->updatePost($post, $dto);

        return new PostResource($updatedPost);
    }

    public function destroy(Post $post): JsonResponse
    {
        $this->postService->deletePost($post);

        return response()->json([
            'message' => 'Post deleted successfully'
        ]);
    }

    public function publish(Post $post): PostResource
    {
        $publishedPost = $this->postService->publishPost($post);

        return new PostResource($publishedPost);
    }

    public function archive(Post $post): JsonResponse
    {
        $archivedPost = $this->postService->archivePost($post);

        return response()->json([
            'message' => 'Post archived successfully',
            'data' => $archivedPost
        ]);
    }
}