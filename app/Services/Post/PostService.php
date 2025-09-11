<?php

namespace App\Services\Post;

use App\Models\Post;
use App\Dto\PostDto\PostStoreDto;
use App\Dto\PostDto\PostUpdateDto;
use App\Repositories\Post\PostRepositoryInterface;
use App\Enums\Status;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Js;

class PostService implements PostServiceInterface
{
    public function __construct(
        private PostRepositoryInterface $postRepository
    ) {
    }

    public function getPublishedPosts(int $userId): Collection
    {
        return $this->postRepository->getPublishedPosts($userId);
    }

    public function getAllPostsByUser(int $userId): Collection
    {
        return $this->postRepository->getAllPostsByUser($userId);
    }

    public function getPostById(int $id): ?Post
    {
        return $this->postRepository->getPostById($id);
    }

    public function createPost(int $userId, PostStoreDto $dto): Post
    {
        try {
            $data = [
                'user_id' => $userId,
                'title' => $dto->title,
                'status' => $dto->status,
                'body' => $dto->body
            ];

            return $this->postRepository->create($data);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function updatePost(Post $post, PostUpdateDto $dto): Post
    {
        $data = array_filter([
            'title' => $dto->title,
            'status' => $dto->status,
            'body' => $dto->body
        ], fn($value) => !is_null($value));

        return $this->postRepository->update($post, $data);
    }

    public function deletePost(Post $post): bool
    {
        return $this->postRepository->delete($post);
    }

    public function publishPost(Post $post): Post
    {
        return $this->postRepository->update($post, [
            'status' => Status::PUBLISHED->value
        ]);
    }

    public function archivePost(Post $post): Post
    {
        return $this->postRepository->update($post, [
            'status' => Status::ARCHIVED->value
        ]);
    }
}