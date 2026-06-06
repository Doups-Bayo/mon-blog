<?php

namespace App\Http\Controllers;

use App\Models\Share;
use App\Models\Post;
use Illuminate\Http\Request;

class ShareController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'platform' => 'required|in:facebook,twitter,whatsapp,copy',
        ]);

        // Enregistrer le partage en base de données
        Share::create([
            'post_id'  => $post->id,
            'user_id'  => auth()->id(),
            'platform' => $request->platform,
        ]);

        // Générer le lien de partage selon la plateforme
        $url = route('posts.show', $post->slug);

        $shareLinks = [
            'facebook' => 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode($url),
            'twitter'  => 'https://twitter.com/intent/tweet?url=' . urlencode($url) . '&text=' . urlencode($post->title),
            'whatsapp' => 'https://wa.me/?text=' . urlencode($post->title . ' ' . $url),
            'copy'     => $url,
        ];

        return response()->json([
            'link' => $shareLinks[$request->platform]
        ]);
    }
}