<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Post;

class PostController extends Controller
{
    public function index()
{
    $posts = Post::latest()->paginate(20);

        return view('admin/post',compact('posts'));
    }

    public function create()
    {
        return view('admin/post');
    }
    public function store(PostRequest $request)
    {
        $post = Post::create($request->all());

        return back()->withMessage('');
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('admin/post',compact('posts'));
    }

    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->all());

        return back()->withMessage('');
    }

    public function destroy($id)
    {
        Post::destroy($id);

        return view('admin/post',compact('posts'));
    }
}