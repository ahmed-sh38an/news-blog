<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['comment', 'slug', 'commentor', 'post_id', 'created_at', 'user_id', 'admin_id'];

    public function post(Post $post)
    {
        return $this->belongsTo($post);
    }

    public function user(User $user)
    {
        return $this->belongsTo($user);
    }

    public function admin(Admin $user)
    {
        return $this->belongsTo($user);
    }

    public function commentable()
    {
        return $this->morphTo();
    }
}