<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SettingsUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showSettings()
    {
    	$title = 'Settings';

    	$user = Auth::user();

    	return  view('user.settings', [
    		'title' => $title,
    		'user' => $user
    	]);
    }

    public function settings(Request $request)
    {
    	$validatedData = $request->validate([
	        'name' => 'required|max:64|min:3',
            'image' => 'image|mimes:jpeg,png,jpg,|max:2048'
	    ]);

    	$name = $request->input('name');

    	$user = Auth::user();

    	$user->name = $name;
        
        if(isset(request()->image)){
            //$imageName = time().'.'.request()->image->getClientOriginalExtension();

            //request()->image->move(public_path('images/profile'), $imageName);
            if($user->img != 'profile/no.png') {
                Storage::disk('public')->delete($user->img);
            }

            $path = $request->file('image')->storeAs('profile', $user->id . '_profile', 'public');

            $user->img = $path;
        }

    	$user->save();

    	return redirect()->route('profile', ['id' => $user->id]);
    }
}
