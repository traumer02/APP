<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StorePostRequest;
use App\Http\Requests\User\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function store(StorePostRequest $request)
    {
        $user = Auth::user();
        $post = $user->posts()->create($request->validated());

        return response()->json($post, 201);
    }

    public function update(UpdatePostRequest $request, $id)
    {
        $user = Auth::user();
        $post = $user->posts()->findOrFail($id);

        $post->update($request->validated());

        return response()->json($post, 200);
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $post = $user->posts()->findOrFail($id);

        $post->delete();

        return response()->json(['message' => 'Post deleted successfully.'], 200);
    }

    public function index()
    {
        $user = Auth::user();
        $posts = Post::whereIn('user_id', $user->subscriptions()->pluck('user_id'))->get();

        return response()->json($posts, 200);
    }
}
