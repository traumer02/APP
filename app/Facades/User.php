<?php

namespace App\Facades;

use App\Services\User\Data\RegisterUserData;
use App\Services\User\UserService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \App\Models\User store(RegisterUserData $data)
 * @method static array login(\App\Services\User\Data\LoginData $data)
 * @method static array updateAvatar(\Illuminate\Http\UploadedFile $avatar)
 * @see \App\Services\User\UserService
 * */

class User extends Facade {
    protected static function getFacadeAccessor():string
    {
        return UserService::class;
    }
}
