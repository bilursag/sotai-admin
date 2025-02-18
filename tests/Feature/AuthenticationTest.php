<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_login_with_email()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'rut' => '12345678-9',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/login', [
            'login' => 'test@example.com',
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($user);
    }

    public function test_a_user_can_login_with_rut()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'rut' => '12345678-9',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/login', [
            'login' => '12345678-9',
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($user);
    }

    public function test_a_user_cannot_login_with_invalid_credentials()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'rut' => '12345678-9',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/login', [
            'login' => 'test@example.com',
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }
}
