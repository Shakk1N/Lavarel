<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Blog\PostController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\BlogCategoryController;

Route::get('blog/posts', [PostController::class, 'index']);

Route::apiResource('blog/categories', BlogCategoryController::class);
Route::apiResource('blog/categories', \App\Http\Controllers\Api\BlogCategoryController::class);


Route::get('/blog/posts/{id}', [BlogPostController::class, 'show']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
