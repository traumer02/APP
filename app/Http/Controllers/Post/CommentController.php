<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreCommentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request)
    {
        $user = Auth::user();
        $comment = $user->comments()->create($request->validated());

        return response()->json($comment, 201);
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $comment = $user->comments()->findOrFail($id);

        $comment->delete();

        return response()->json(['message' => 'Comment deleted successfully.'], 200);
    }
}
