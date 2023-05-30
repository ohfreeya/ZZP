<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class AccountTest extends TestCase
{
    use RefreshDatabase, WithFaker, WithoutMiddleware;
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
        $this->withoutMiddleware();
        $user = User::factory()->create();
        // test login page
        $response = $this->post('/login', [
            '_token' => csrf_token(),
            'username' => $user->name,
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

    /**
     * test register page
     */
    public function test_register(): void
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    public function test_register_account(): void
    {
        $data = [
            'username' => 'test',
            'email' => 'test@test.com',
            'password' => 'test',
        ];
        $response = $this->post('/register', $data);
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    /**
     * test register email is existed
     */
    public function test_register_email_existed(): void
    {
        $user = User::factory()->create();
        $data = [
            'username' => $user->name,
            'email' => $user->email,
            'password' => 'test',
        ];
        $response = $this->post('/register', $data);
        $response->assertStatus(302);
        $response->assertRedirect('/register');
    }
    
    
    /**
     * forgot password page
     */
    public function test_forgot_password(): void
    {
        $response = $this->get('/forgot');
        $response->assertStatus(200);
    }

    /**
     * verify email and send email
     */
    public function test_verify_email(): void
    {
        $user = User::factory()->create(['email' => 'test@example.com']);
        Mail::fake();
        $response = $this->post('/verify/email', [
            'email' => $user->email,
        ]);
         // You can also assert that the email was sent
         $this->assertDatabaseHas('reset_passwords', ['email' => 'test@example.com']);
         Mail::assertSent(ResetPWDEmail::class, function ($mail) use ($user) {
            $mail->build();
            return $mail->hasTo('test@example.com') && $user->reset_token &&  $user->reset_link;
         });
    }
    
    /**
     * logout
     */
    public function test_logout(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('logout');
        $response->assertStatus(302);
        $response->assertRedirect('login');
    }
    
}