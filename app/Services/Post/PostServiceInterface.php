<?php

namespace App\Services\Post;

use App\Models\Post;
use App\Dto\PostDto\PostStoreDto;
use App\Dto\PostDto\PostUpdateDto;
use Illuminate\Database\Eloquent\Collection;

interface PostServiceInterface
{
    public function getPublishedPosts(int $userId): Collection;
    public function getAllPostsByUser(int $userId): Collection;
    public function getPostById(int $id): ?Post;
    public function createPost(int $userId, PostStoreDto $dto): Post;
    public function updatePost(Post $post, PostUpdateDto $dto): Post;
    public function deletePost(Post $post): bool;
    public function publishPost(Post $post): Post;
    public function archivePost(Post $post): Post;
}