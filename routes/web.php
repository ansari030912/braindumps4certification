<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

// Route for the homepage
Route::get('/', [HomeController::class, 'index'])->name('home.index');

// Route for individual posts by post_name
Route::get('/{post_name}', [HomeController::class, 'show'])->name('post.show');

// Route for category pages by slug
Route::get('/category/{slug}', [CategoryController::class, 'getCategoryPosts'])->name('category.show');

// Route for posting comments
Route::post('/post-comment', [HomeController::class, 'postComment'])->name('comment.post');
