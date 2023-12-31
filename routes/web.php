<?php

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    \Illuminate\Support\Facades\DB::listen(function ($query){
        logger($query->sql);
    });
    return view('posts', [
            "posts" => Post::with('category')->get()
        ]
    );}
);


Route::get("/posts/{post:slug}", fn(Post $post) => view(
    'post', [
    "post" => $post

]));


Route::get("/categories/{category:slug}", fn(Category $category) => view(

    'posts', [
    "posts" => $category->posts

]));


