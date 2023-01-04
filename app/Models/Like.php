<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'post_id', 'like'];

    public function post(Post $post)
    {
        return $this->belongsTo($post);
    }

    public function likeable()
    {
        return $this->morphTo();
    }

}