<?php

namespace App\Services\User\Data;

use Illuminate\Support\Facades\Hash;
use Spatie\LaravelData\Data;
use Spatie\laravelData\Attributes\Computed;

class RegisterUserData extends Data {
    public function __construct(
        public string $name,
        public string $email,
        public string $login,
        #[Computed]
        public string $password,
    )
    {
        $this->password = Hash::make($this->password);
    }
}
