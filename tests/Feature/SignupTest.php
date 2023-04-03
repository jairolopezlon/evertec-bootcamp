<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\User;

class SignupTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testSignupPageExist(): void
    {
        $response = $this->get('/signup');
        $response->assertStatus(200);
    }

    public function testSignupPageHasSignupForm(): void
    {
        $response = $this->get('/signup');
        $response->assertSeeInOrder(['form', 'id', 'signupForm', 'form']);
    }

    public function testSignupWithValidData()
    {
        $userData = [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->post('/signup', $userData);

        $response->assertRedirect('/email/verify/notice');

        $this->assertAuthenticated();
        $this->assertEquals($userData['email'], session('email'));
        $this->assertDatabaseHas('users', [
            'email' => session('email'),
        ]);
    }

    public function testSignupWithInvalidData()
    {
        $userData = [
            'name' => $this->faker->name(),
            'email' => 'dasdasd.com',
            'password' => 'pas23',
            'password_confirmation' => 'password123',
        ];

        $response = $this->post('/signup', $userData);

        $response->assertSessionHasErrors();

        $user = User::where('email', $userData['email'])->first();
        $this->assertNull($user);
    }
}
