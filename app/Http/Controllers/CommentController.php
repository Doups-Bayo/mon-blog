<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CommentController extends Controller
{
    use AuthorizesRequests;

    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content'   => 'required|min:2|max:1000',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        Comment::create([
            'post_id'   => $post->id,
            'user_id'   => auth()->id(),
            'parent_id' => $request->parent_id,
            'content'   => $request->content,
        ]);

        return back()->with('success', 'Commentaire ajouté !');
    }

    public function update(Request $request, Comment $comment)
    {
        $this->authorize('delete', $comment);

        $request->validate([
            'content' => 'required|min:2|max:1000',
        ]);

        $comment->update([
            'content' => $request->content,
        ]);

        return back()->with('success', 'Commentaire modifié !');
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();
        return back()->with('success', 'Commentaire supprimé !');
    }
}