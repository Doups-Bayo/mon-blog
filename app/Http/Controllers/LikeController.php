<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggle(Post $post)
    {
        $existing = Like::where('post_id', $post->id)
                        ->where('user_id', auth()->id())
                        ->first();

        if ($existing) {
            // Déjà liké → on retire le like
            $existing->delete();
            $message = 'Like retiré !';
        } else {
            // Pas encore liké → on ajoute le like
            Like::create([
                'post_id' => $post->id,
                'user_id' => auth()->id(),
            ]);
            $message = 'Post liké !';
        }

        return back()->with('success', $message);
    }
}