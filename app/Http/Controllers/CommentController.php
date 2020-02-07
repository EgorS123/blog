<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Comments;

class CommentController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {
    	$user = Auth::user();

    	$comment = new Comments;

    	$comment->post_id = $request->input('post');
    	$comment->user_id = $user->id;
    	$comment->user_name = $user->name;
    	$comment->content = $request->input('content');

    	$comment->save();

    	return redirect()->route('post', ['id' => $request->input('post')]);
    }
}
