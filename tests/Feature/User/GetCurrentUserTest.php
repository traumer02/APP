<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class GetCurrentUserTest extends TestCase
{

    public function test_success_get_current_user(): void
    {
        $response = $this->get(route('user.current'));

        $response->assertOk();
        $response->assertJsonStructure([
            'id', 'name', 'email', 'subscribers',
            'publications', 'avatar', 'about',
            'isVerified', 'registeredAt'
        ]);
    }
}
