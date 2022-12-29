<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Request $request, $id)
    {
        // $postId = $request->post_id;

        $userId = Auth::user()->id;
        $like = Like::where('post_id', $id)->where('user_id', $userId)->first();
        if (!$like) {
            Like::create([
                'user_id' => $userId,
                'post_id' => $id,
                'like' => 1,
            ]);
            return response(
                1
            );
        } else {
            $like->delete();
            return response(
                0
            );
        }
    }

    public function count($id)
    {
        $likes = Like::where('post_id', $id)->count();

        return $likes;
    }
}