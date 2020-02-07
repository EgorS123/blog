<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function showCreate()
    {
    	$user = Auth::user();

    	return view('user.post.create', [
    		'user' => $user,
    		'title' => 'Create Post'
    	]);
    }

    public function create(Request $request)
    {
    	$validatedData = $request->validate([
	        'title' => 'required|max:64|min:3',
	        'content' => 'required'
	    ]);

    	$user = Auth::user();

    	$title = $request->input('title');

    	$content = $request->input('content');

    	$id = $user->id;

    	Post::myCreate($title, $content, $id);

    	return redirect()->route('profile', ['id' => $id]);
    }

    public function showEdit($id)
    {
        $post = Post::find($id);

        $user = Auth::user();

        return view('user.post.edit', [
            'user' => $user,
            'post' => $post,
            'title' => 'Edit post ' . $post->title
        ]);
    }

    public function edit(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:64|min:3',
            'content' => 'required'
        ]);

        $user = Auth::user();

        $post = Post::myChange($id, $request->input('title'), $request->input('content'));

        return redirect()->route('profile' , ['id' => $user->id]);
    }
}
