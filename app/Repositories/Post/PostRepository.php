<?php

namespace App\Repositories\Post;

use App\Models\Post;
use App\Enums\Status;


class PostRepository implements PostRepositoryInterface
{
    public function getPublishedPosts(int $userId)
    {
        return Post::where('user_id', $userId)
            ->where('status', Status::PUBLISHED->value)
            ->get();
    }

    public function getAllPostsByUser(int $userId)
    {
        return Post::where('user_id', $userId)->get();
    }

    public function getPostById(int $id)
    {
        return Post::where('id', $id)->first();
    }

    public function create(array $data): Post
    {
        return Post::create($data);
    }

    public function update(Post $post, array $data): Post
    {
        $post->update($data);
        return $post->fresh();
    }

    public function delete(Post $post): bool
    {
        return $post->delete();
    }
}
