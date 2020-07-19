<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function  getDashboard(){
        $posts = Post::orderBy("created_at" , "desc")->get();

        return view("dashboard",compact("posts"));
     }

    public function postSignUp(Request $request){


        $validatedData = $request->validate([
            'email' => 'required|email|unique:users',
            'first_name' => 'required|max:120',
            'password' => 'required|min:4',
        ]);

        $email = $request['email'];
        $first_name = $request['first_name'];
        $password = bcrypt($request['password']);

        $user = new User();
        $user->email =  $email;
        $user->first_name =  $first_name;
        $user->password =  $password;

        $user->save();
        Auth::login($user);
        return redirect()->route("dashboard");
    }
    public function postSignIn(Request $request){
        $validatedData = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $email = $request['email'];
        $password = $request['password'];
        if(Auth::attempt(['email' => $email, 'password' => $password])){
            return redirect()->route("dashboard");
        }
        return redirect()->back();
    }

    public function getlogOut(){
        Auth::logout();
        return redirect()->route("home");
    }


    public function getAccount(){        
        return view("account" , ['user'=>Auth::user()]);
    }

    
    public function saveAccount(Request $request){      
        $validatedData = $request->validate([
            'first_name' => 'required', 
        ]);
        $user = Auth::user();
        $user->first_name = $request->first_name;
        $user->update();
        $file = $request->file('image');
        $filename = $request['first_name'].'-'.$user->id.'.jpg';
        if($file){
            Storage::disk('local')->put($filename , File::get($file));
        }
        return redirect()->route("account.get");
    }

    
    public function imageAccount($filename){        
        $path_to_file = Storage::disk('local')->url($filename);      
        return $path_to_file;
    }
    
    
    
}
