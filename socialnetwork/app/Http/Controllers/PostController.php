<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Like;
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
        if($post->update()){
            $message = "Пост успешно обновлен!";
        }
        return response()->json(['message'=>$message, 'new_body'=>$post->body]);
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
    public function postLikePost(Request $request){
        $post_id = $request['post_id'];
        $isLike = $request['isLike'] === 'true' ? true : false; 
        $update = false;
        $post = Post::find($post_id);
        if(!$post){
            return null;
        }
        $user = Auth::user();
        $like = $user->likes()->where('post_id',$post_id )->first();
        if($like){
            $already_like = $like->like;
            $update = true;
            if($already_like == $isLike){
                $like->delete();
                return null;
            }
        }else{
            $like = new Like();
       
        }
        $like->like = $isLike;
        $like->user_id = $user->id;
        $like->post_id = $post->id;
        if($update){
            $like->update();
        }else{
            $like->save();
        }
        return null;
    }
}
