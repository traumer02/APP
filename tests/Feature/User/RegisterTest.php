<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    public function test_success_register():void
    {
        $data =[
            "name"=>fake()->name,
            "login"=>fake()->unique()->userName,
            "email"=>fake()->unique()->email,
            "password"=>"12345678",
            "password_confirmation"=>"12345678"
        ];

        $response = $this->post(route('user.register'), $data);

        $response->assertCreated();

        $this->assertDatabaseHas(User::class, [
            'id' => $response->json('id'),
            'name' => Arr::get($data, 'name'),
            'login' =>Arr::get($data, 'login'),
            'email' => Arr::get($data, 'email'),
        ]);
    }

    public function test_register_validation(): void
    {
        $response = $this->post(route('user.register'),[
            "name"=>null,
            "login"=>null,
            "email"=>"traumergmail.com",
            "password"=>"12345678",
            "password_confimation"=>"123"
        ]);

        $response->assertUnprocessable();
        $response->assertJsonValidationErrors(['name', 'login', 'email', 'password']);
    }
}
