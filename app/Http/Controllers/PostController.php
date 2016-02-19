<?php


namespace App\Http\Controllers;


class PostController extends Controller
{
    public function getIndex()
    {
        return view('magazine.posts.index', ['posts' => \App\Post::paginate(5)]);
    }
}