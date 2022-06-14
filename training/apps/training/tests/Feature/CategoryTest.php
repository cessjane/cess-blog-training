<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_category_can_be_added_by_any_user()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/categories', [
            'name' => 'Test Category',
            'updated_user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('categories', [
            'name' => 'Test Category',
        ]);
        $response->assertRedirect('/categories');
    }

    public function test_category_can_be_deleted()
    {
        $category = Category::factory()->create();

        $category->delete();
        $this->assertModelMissing($category);
    }
}
