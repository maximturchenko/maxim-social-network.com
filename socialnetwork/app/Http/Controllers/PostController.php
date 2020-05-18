<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function postCreate(Request $request){
        $validatedData = $request->validate([
            'body' => 'required|max:1000',
        ]);
        $post = new Post();
        $post->body = $request['body'];
        if($request->user()->posts()->save($post)){
            $message = "Ваш пост успешно добавлен!";
        }
        return redirect()->route("dashboard")->with('message', $message);
    }

    public function deletePost($post_id){
        $post = Post::find($post_id);
        if(Auth::user() != $post->user){
            return redirect()->back();
        }
        $post->delete();
        $message = "Пост успешно удален!";
        return redirect()->route("dashboard")->with('message', $message);
    }


}
