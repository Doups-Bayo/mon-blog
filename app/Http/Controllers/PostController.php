<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $posts = Post::with('user', 'categories', 'likes', 'comments')
                     ->where('status', 'published')
                     ->latest('published_at')
                     ->paginate(10);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|min:5|max:255',
            'content' => 'required|min:10',
            'image'   => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        $post = Post::create([
            'user_id'      => auth()->id(),
            'title'        => $request->title,
            'slug'         => Str::slug($request->title) . '-' . time(),
            'content'      => $request->content,
            'image'        => $imagePath,
            'status'       => 'published',
            'published_at' => now(),
        ]);

        if ($request->categories) {
            $post->categories()->attach($request->categories);
        }

        return redirect()->route('posts.show', $post->slug)
                         ->with('success', 'Post publié avec succès !');
    }

    public function show($slug)
    {
        $post = Post::with('user', 'categories', 'likes', 'comments.user', 'comments.replies.user')
                    ->where('slug', $slug)
                    ->firstOrFail();

        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $request->validate([
            'title'   => 'required|min:5|max:255',
            'content' => 'required|min:10',
            'image'   => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $post->image = $request->file('image')->store('posts', 'public');
        }

        $post->update([
            'title'   => $request->title,
            'slug'    => Str::slug($request->title) . '-' . time(),
            'content' => $request->content,
            'image'   => $post->image,
        ]);

        if ($request->categories) {
            $post->categories()->sync($request->categories);
        }

        return redirect()->route('posts.show', $post->slug)
                         ->with('success', 'Post mis à jour !');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect()->route('posts.index')
                         ->with('success', 'Post supprimé !');
    }
}