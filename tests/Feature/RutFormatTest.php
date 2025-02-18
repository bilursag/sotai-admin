<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RutFormatTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_login_with_formatted_rut()
    {
        $user = User::factory()->create([
            'rut' => '12345678-9',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/login', [
            'login' => '12345678-9',
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($user);
    }

    public function test_a_user_can_login_with_unformatted_rut()
    {
        $user = User::factory()->create([
            'rut' => '12345678-9',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/login', [
            'login' => '12345678-9',
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($user);
    }
}
