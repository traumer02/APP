<?php

namespace App\Services\User;




use App\Exceptions\User\InvalidUserCredentialsException;
use App\Http\Resources\User\CurrentUserResource;
use App\Models\User;
use App\Services\User\Data\LoginData;
use App\Services\User\Data\RegisterUserData;
use Illuminate\Http\UploadedFile;
use Laravel\Sanctum\NewAccessToken;

class UserService
{
    public function store(RegisterUserData $data)
    {
        return User::query()->create($data->toArray());

    }

    public function login(LoginData $data):array
    {
        if(!auth()->guard('web')->attempt($data->toArray())){
            throw new InvalidUserCredentialsException('Invalid user credentials exception. ');
        }


        /** @var NewAccessToken $token */
        $token = auth()->user()->createToken('api_login');
        return [
            'token' => $token->plainTextToken,
        ];
    }

    public function updateAvatar(UploadedFile $avatar):User
    {
        $path = $avatar->storePublicly('avatars');

        $url = config('app.url'."/storage/$path");



        return auth()->user()->update([
            'avatar' => $url
        ]);


    }

    public function findUserByIdentifier($identifier)
    {
        return User::where('id', $identifier)
            ->orWhere('login', $identifier)
            ->first();
    }
}
