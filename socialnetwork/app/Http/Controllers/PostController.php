<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function createPost(Request $request){
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

    public function editPost(Request $request){
        $validatedData = $request->validate([
            'body' => 'required|max:1000',
        ]);
        $post = Post::find($request['post_id']);
        if(Auth::user() != $post->user){
            return redirect()->back();
        }
        $post->body = $request['body'];
        if($request->user()->posts()->save($post)){
            $message = "Пост успешно обновлен!";
        }
        return response()->json(['message'=>$message]);
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
