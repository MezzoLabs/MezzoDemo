<?php


namespace App\Http\Controllers;


use App\Http\Requests\ShowPostRequest;

class PostController extends Controller
{
    public function getIndex()
    {
        return view('magazine.posts.index', ['posts' => \App\Post::paginate(5)]);
    }

    public function getShow(ShowPostRequest $request, $id)
    {
        return view('magazine.posts.show', ['post' => \App\Post::findOrFail($id)]);
    }
}