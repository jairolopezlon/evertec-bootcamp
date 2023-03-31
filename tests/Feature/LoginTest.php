<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{

    public function testLoginPageExist(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function testLoginPageHasLoginForm(): void
    {
        $response = $this->get('/login');
        $response->assertSeeInOrder(['form', 'id', 'loginForm', 'form']);
    }

    public function testLoginSuccess(): void
    {
        $emailTest = 'test@test.com';
        $passwordTest = 'password';

        $existingUser = User::where('email', $emailTest)->first();

        if (!$existingUser) {
            $user = User::factory()->create([
                'email' => $emailTest,
                'password' => Hash::make($passwordTest),
            ]);
        } else {
            $user = $existingUser;
        }

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $passwordTest,
        ]);

        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);
    }

    public function testLoginFailureWithPasswordWrong(): void
    {

        $emailTest = 'test@test.com';
        $passwordTest = 'password';

        $existingUser = User::where('email', $emailTest)->first();

        if (!$existingUser) {
            $user = User::factory()->create([
                'email' => $emailTest,
                'password' => Hash::make($passwordTest),
            ]);
        } else {
            $user = $existingUser;
        }

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password544',
        ]);

        $response->assertRedirect('/login');
        $this->assertGuest();
    }
}
