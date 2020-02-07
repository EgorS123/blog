<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Post;
use App\Comments;
use App\User;

class PublicPostController extends Controller
{
    public function showPost($id)
    {
        $post = Post::find($id);

        $user = User::find($post->author_id);

        $comments = Comments::where('post_id', $post->id)->get();

        return view('post', [
            'post' => $post,
            'user' => $user,
            'comments' => $comments,
            'title' => $post->title,
        ]);
    }

}
