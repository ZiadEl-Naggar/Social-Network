<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\Profile;
use \App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index($user){
        dd(User::find($user));
    }

    public function show($user){
        $user = User::findOrFail($user);
        $accepted = null;
        $posts = null;
        
        $friends = [];
        if(!$user->friends->isEmpty()){
            foreach ($user->friends->where('accepted', 1) as $friend) {
                $friends[$friend->requestedfriend->id] = $friend->requestedfriend->name;
            }
        }

        if(Auth::user()->id != $user->id){
            $profile = 0;
            if (!Auth::user()->friends->where('friend_id', $user->id)->isEmpty()) {
                $friend = Auth::user()->friends->where('friend_id', $user->id)->first();
                $accepted = $friend->accepted;
                if(!$user->posts->isEmpty()){
                    if($accepted == 1){
                        $posts = $user->posts->sortByDesc('id');
                    } else {
                        $posts = $user->posts->where('privacy', 'public')->sortByDesc('id');
                    }
                }
                return view('profile/profile', ['user'=>$user, 'profile'=>$profile, 'accepted'=>$accepted, 'posts'=>$posts, 'friends'=>$friends]);
            } else if($friend = Friend::where('friend_id', Auth::user()->id)->where('user_id', $user->id)->first()){
                $accepted = $friend->accepted;
                $received = 1;
                if(!$user->posts->isEmpty()){
                    if($accepted == 1){
                        $posts = $user->posts->sortByDesc('id');
                    } else {
                        $posts = $user->posts->where('privacy', 'public')->sortByDesc('id');
                    }
                }
                return view('profile/profile', ['user'=>$user, 'profile'=>$profile, 'accepted'=>$accepted, 'posts'=>$posts, 'friends'=>$friends, 'received'=>$received]);
            }
            if(!$user->posts->isEmpty()){
                $posts = $user->posts->where('privacy', 'public')->sortByDesc('id');
            }
            return view('profile/profile', ['user'=>$user, 'profile'=>$profile, 'accepted'=>$accepted, 'posts'=>$posts, 'friends'=>$friends]);
        }
        $profile = 1;
        if(!$user->posts->isEmpty()){
            $posts = $user->posts->sortByDesc('id');
        }
        return view('profile/profile', ['user'=>$user, 'profile'=>$profile, 'accepted'=>$accepted, 'posts'=>$posts, 'friends'=>$friends]);
    }

    public function edit($user){
        $user = User::findOrFail($user);
        return view('profile/editprofile', ['user'=>$user,]);
    }

    public function create($user){
        $user = User::findOrFail($user);
        return view('profile/profile', ['user'=>$user,]);
    }

    public function store(Request $request){
        $user = User::find(Auth::user()->id);
        if($request->name){
            $user->name = $request->name;
        }
        if($request->image){
            $path = $request->image->store('/uploads', 'public');
            $url = Storage::url($path);
            $user->profile->image = $url;
        }
        if($request->bdate){
            $user->profile->birthdate = $request->bdate;
        }
        if($request->education){
            $user->profile->education = $request->education;
        }
        if($request->work){
            $user->profile->work = $request->work;
        }
        if($request->about){
            $user->profile->about = $request->about;
        }
        $user->profile->save();
        $user->save();
        return redirect(url('/profile/'.$user->id));
    }
}