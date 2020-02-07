<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Post;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($id)
    {
    	$user = Auth::user();

    	$pr_user = User::find($id);

        if($pr_user == null) {
            abort(404);
        }

    	if($user->id == $pr_user->id) {
    		$guest = false;
    	}else{
    		$guest = true;
    	}

    	$title = $pr_user->name;

        $posts = Post::where('author_id', $pr_user->id)->orderBy('created_at', 'desc')->take(10)->get();

        return view('user.index', [
        	'guest' => $guest,
        	'user' => $user,
        	'pr_user' => $pr_user,
            'posts' => $posts,
        	'title' => $title,
        ]);
    }
}
