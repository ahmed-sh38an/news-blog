<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['comment', 'slug', 'commentor', 'post_id', 'created_at'];

    public function comments(Post $post)
    {
        return $this->belongsTo($post);
    }

    public function commentor(User $user)
    {
        return $this->belongsTo($user);
    }

    public function adminCommentor(Admin $user)
    {
        return $this->belongsTo($user);
    }
}