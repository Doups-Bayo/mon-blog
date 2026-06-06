<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ShareController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Page d'accueil → liste des posts
Route::get('/', [PostController::class, 'index'])->name('home');

// Routes des posts (lecture publique)
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

// Routes protégées (connecté obligatoire)
Route::middleware('auth')->group(function () {

    // Posts
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

    // Commentaires
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    // Likes
    Route::post('/posts/{post}/like', [LikeController::class, 'toggle'])->name('posts.like');

    // Partages
    Route::post('/posts/{post}/share', [ShareController::class, 'store'])->name('posts.share');

    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Cette route doit être APRÈS les routes protégées !
Route::get('/posts/{slug}', [PostController::class, 'show'])->name('posts.show');

require __DIR__.'/auth.php';