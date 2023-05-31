<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;
use Tests\TestCase;

class UserVerificationTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testSuccessfulRegistrationWithEmailNotVerified(): void
    {
        Notification::fake();

        $this->post('/signup', [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();

        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'email_verified_at' => null,
        ]);

        $user = User::where('email', 'johndoe@example.com')->first();

        assertFalse($user->hasVerifiedEmail());
    }

    public function testSuccessfulRegistrationWithEmailVerified(): void
    {
        Notification::fake();

        $this->post('/signup', [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();

        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'email_verified_at' => null,
        ]);

        $user = User::where('email', 'johndoe@example.com')->first();
        $user->markEmailAsVerified();
        assertTrue($user->hasVerifiedEmail());
    }

    public function testSuccessfulEmailVerification(): void
    {
        Notification::fake();

        $userData = [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->post('/signup', $userData);

        $this->assertAuthenticated();

        $response->assertRedirectToRoute('verification.notice');

        $user = User::where('email', $userData['email'])->first();

        $url = URL::signedRoute('verification.verify', ['id' => $user->id, 'hash' => sha1($user->email)]);
        $this->get($url);

        $updatedUser = User::find($user->id);
        $this->assertNotNull($updatedUser->fresh()->email_verified_at);
    }

    public function testRedirectToLoginWhenUserRegisterAndNoAutenticated(): void
    {
        $userData = [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->post('/signup', $userData);
        Auth()->logout();
        $this->assertGuest();

        $responseVerificationResend = $this->get(route('verification.resend'));
        $responseVerificationResend->assertRedirect('/login');

        $user = User::where('email', $userData['email'])->first();
        $url = URL::signedRoute('verification.verify', ['id' => $user->id, 'hash' => sha1($user->email)]);
        $responseVerificationVerify = $this->get($url);
        $responseVerificationVerify->assertRedirect('/login');

        $responseVerificationNotice = $this->get(route('verification.notice'));
        $responseVerificationNotice->assertRedirect('/login');
    }

    public function testRedirectToHomeWhenUserRegisterAndAutenticated(): void
    {
        $userData = [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->post('/signup', $userData);
        $this->assertAuthenticated();
        $user = User::where('email', $userData['email'])->first();
        $user->markEmailAsVerified();

        $responseVerificationResend = $this->get(route('verification.resend'));
        $responseVerificationResend->assertRedirect(route('home'));

        $url = URL::signedRoute('verification.verify', ['id' => $user->id, 'hash' => sha1($user->email)]);
        $responseVerificationVerify = $this->get($url);
        $responseVerificationVerify->assertRedirect(route('home'));

        $responseVerificationNotice = $this->get(route('verification.notice'));
        $responseVerificationNotice->assertRedirect(route('home'));
    }
}
