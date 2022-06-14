<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'article_category_id',
        'title',
        'slug',
        'contents',
        'image_path',
        'updated_user_id',
    ];

    /**
     * Get the category associated with the article.
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'article_category_id', 'id');
    }

    /**
     * Get the user associated with the article.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'updated_user_id', 'id');
    }
}
