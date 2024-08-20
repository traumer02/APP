<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\User\InvalidUserCredentialsException;
use App\Facades\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\ShowUserRequest;
use App\Http\Requests\User\SubscribeRequest;
use App\Http\Requests\User\UnsubscribeRequest;
use App\Http\Requests\User\UpdateAvatarRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\User\CurrentUserResource;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function user()
    {
        return new CurrentUserResource(auth()->user());
    }

    public function avatar(UpdateAvatarRequest $request)
    {
        $user = $request->user();

        $filename = 'images/' . $request->avatar->getClientOriginalName();
        $request->avatar->storeAs('images', $filename, 'public');

        $user->update(
            [
                'avatar' => $filename
            ]
        );

        return $user;
    }

    public function update(UpdateUserRequest $request)
    {
        $user = Auth::user();
        $user->update($request->validated());


        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
            $user->save();
        }

        return response()->json(new CurrentUserResource($user), 200);
    }

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function show(Request $request, $identifier)
    {
        $user = $this->userService->findUserByIdentifier($identifier);

        if (!$user) {
            throw new InvalidUserCredentialsException('User not found');
        }

        return response()->json(new CurrentUserResource($user), 200);
    }

    public function subscribe(SubscribeRequest $request)
    {
        $user = Auth::user();
        $targetUser = $request->input('target_user_id');

        $user->subscriptions()->attach($targetUser);

        return response()->json(['message' => 'Subscribed successfully.'], 200);
    }

    public function unsubscribe(UnsubscribeRequest $request)
    {
        $user = Auth::user();
        $targetUser = $request->input('target_user_id');
        $user->subscriptions()->detach($targetUser);

        return response()->json(['message' => 'Unsubscribed successfully.'], 200);
    }
}

