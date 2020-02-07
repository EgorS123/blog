<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public static function myCreate($title, $content, $author_id)
    {
    	$post = new self;

    	$post->title = $title;
    	$post->author_id = $author_id;
    	$post->content = $content;

    	$post->save();
    }

    public static function myChange($id, $title, $content)
    {
    	$post = self::find($id);

    	$post->title = $title;
    	$post->content = $content;

    	$post->save();
    }
}
