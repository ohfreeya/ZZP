<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     */
    public function test_login(): void
    {
        // test login page
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function test_login_validate(): void
    {
        $user = User::factory()->create();
        // test login page
        $response = $this->post('/login', [
            '_token' => csrf_token(),
            'email' => $user->email,
            'password' => 'test',
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/home');
    }

    /**
     * test login action after vaildation
     */
    public function test_login_after_validate(): void
    {
        $user = User::factory()->create();
        //test login
        $response = $this->actingAs($user)
                            ->get('/home');
        $response->assertStatus(200);
    }
}