<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_list_can_be_rendered_if_authenticated()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/users');
        $response->assertStatus(200);
    }

    public function test_user_create_form_can_be_rendered_if_authenticated()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/users/create');
        $response->assertStatus(200);
    }

    public function test_user_edit_form_with_values_can_be_rendered_if_authenticated()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/users/' . $user->id . '/edit');
        $response->assertStatus(200);
        $response->assertSee($user->user_name);
    }

    public function test_only_admin_can_create_user()
    {
        $user = User::factory()->notAdmin()->create();

        $response = $this->actingAs($user)->post('/users', [
            'user_name' => 'Test User Name',
            'first_name' => 'Test First NAme',
            'last_name' => 'Test Last Name',
            'email' => 'test@example.com',
            'role' => '0',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertForbidden();
    }

    public function test_new_user_can_be_added_if_authorized()
    {
        $user = User::factory()->isAdmin()->create();

        $response = $this->actingAs($user)->post('/users', [
            'user_name' => 'user_name',
            'first_name' => 'Test First NAme',
            'last_name' => 'Test Last Name',
            'email' => 'test@example.com',
            'role' => '0',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertDatabaseHas('users', [
            'user_name' => 'user_name',
        ]);
        $response->assertRedirect('/users');
    }
}
