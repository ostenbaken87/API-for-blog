<?php

namespace App\Repositories\Post;

use App\Models\Post;

interface PostRepositoryInterface
{
    public function getPublishedPosts(int $userId);
    public function getAllPostsByUser(int $userId);
    public function getPostById(int $id);
    public function create(array $data): Post;
    public function update(Post $post, array $data): Post;
    public function delete(Post $post): bool;
}