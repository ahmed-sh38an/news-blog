<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = ['title', 'slug', 'description', 'image', 'author_id', 'author'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function creator(Admin $admin)
    {
        return $this->belongsTo($admin);
    }

    public function comments(Comment $comments)
    {
        return $this->hasMany($comments);
    }

    public function likes(Like $like)
    {
        return $this->hasMany($like);
    }
}