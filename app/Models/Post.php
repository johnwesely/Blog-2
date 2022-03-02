<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'excerpt', 'body', 'slug', 'category_id', 'user_id', 'thumbnail'];

    public function category() 
    {
        return $this->belongsTo(Category::class);
    }

    public function author() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments() 
    {
        return $this->hasMany(Comment::class);
    }

    public function scopeFilter($query, array $filters)   // call with Post::newQuery()->filter(), $query passed automatically by laravel 
    { 
        $query->when($filters['search'] ?? false , fn($query, $search) =>
            $query->where(fn($query) =>
                $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%')
                ->orWhere('excerpt', 'like', '%' . $search . '%')
            )
        );
        
        $query->when($filters['category'] ?? false, fn($query, $category) =>
            $query->whereHas('category', fn ($query) =>    // where post has category 
                $query->where('slug', $category)           // where slug matches user browser request
            )
        );

        $query->when($filters['author'] ?? false, fn($query, $author) =>
            $query->whereHas('author', fn ($query) =>      // where post has author
                $query->where('username', $author)         // where author username matches user browser request
            )
        );
    }

}
