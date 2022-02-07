<?php

namespace App\Http\Controllers;

use App\Helpers\ExceptionHelper;
use App\Models\Post;
use Illuminate\Http\Response;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('tags')->withCount('likes')->paginate(10);
        return response()->json($posts);
    }

    public function toggleReaction(Post $post)
    {
        if ($post->author_id === auth()->id()) {
            ExceptionHelper::throwException(Response::HTTP_FORBIDDEN, 'You cannot like your post');
        }

        if ($post->likes()->where('user_id', auth()->id())->exists()) {
            $post->likes()->detach(auth()->id());
            $message = 'You unlike this post successfully';
        } else {
            $post->likes()->attach(auth()->id());
            $message = 'You like this post successfully';
        }

        return response()->json([
            'status' => 200,
            'message' => $message,
        ]);
    }
}
