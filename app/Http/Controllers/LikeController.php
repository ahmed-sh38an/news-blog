<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store($id)
    {
        $userId = Auth::user()->id;
        $like = Like::where('post_id', $id)->where('likeable_id', $userId)->where('likeable_type', 'App\Models\User')->first();
        if (!$like) {
            auth()->user()->likes()->create([
                'post_id' => $id,
                'like' => 1
            ]);
            return response(
                $this->countLikes($id)
            );
        } else {
            $like->delete();
            return response(
                $this->countLikes($id)
            );
        }
    }

    public function love($id)
    {
        $userId = Auth::user()->id;
        $like = Like::where('post_id', $id)->where('likeable_id', $userId)->where('likeable_type', 'App\Models\Admin')->first();
        if (!$like) {
            auth()->user()->likes()->create([
                'post_id' => $id,
                'like' => 1
            ]);
            return response(
                $this->countLikes($id)
            );
        } else {
            $like->delete();
            return response(
                $this->countLikes($id)
            );
        }
    }

    public function countLikes($id)
    {
        $likes = Like::where('post_id', $id)->count();

        return $likes;
    }
}