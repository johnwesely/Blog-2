<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Models\User;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['body', 'user_id'];

    public function post() 
    {
        return $this->belongsTo(Post::class);            // when using class name, laravel deduces column name
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id'); // when using alias, mandatory to include column name
    }
}
