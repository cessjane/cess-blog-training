<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'updated_user_id',
    ];

    /**
     * Get the user associated with the category.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'updated_user_id', 'id');
    }
}
