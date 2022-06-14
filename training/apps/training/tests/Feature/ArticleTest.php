<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_article_can_be_added_by_any_user()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $response = $this->actingAs($user)->post('/articles', [
            'article_category_id' => $category->id,
            'title' => 'Test Title',
            'slug' => 'Test Slug',
            'contents' => 'Test Contents',
            'updated_user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('articles', [
            'title' => 'Test Title',
        ]);
        $response->assertRedirect('/articles');
    }

    public function test_an_article_can_be_deleted()
    {
        $article = Article::factory()->create();

        $article->delete();
        $this->assertModelMissing($article);
    }
}
