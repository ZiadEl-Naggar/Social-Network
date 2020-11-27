<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function store($request){
        if($friend = Friend::where('user_id', Auth::user()->id)->where('friend_id', $request)->first()){
            $friend->accepted = 1;
            $friend->save();
            return redirect('/profile/'.$request);
        } else if($friend = Friend::where('user_id', $request)->where('friend_id', Auth::user()->id)->first()){
            $friend->accepted = 1;
            $friend->save();
            return redirect('/profile/'.$request);
        } else {
            $friend = new Friend();
            $friend->user_id = Auth::user()->id;
            $friend->friend_id = $request;
            $friend->accepted = 0;
            $friend->save();
            return redirect('/profile/'.$request);
        }
    }

    public function destroy($request){
        $user = Auth::user()->id;
        if($friend = Friend::where('user_id', $user)->where('friend_id', $request)->delete() || $friend = Friend::where('user_id', $request)->where('friend_id', $user)->delete()){
            return redirect('/profile/'.$request);
        } else {
            return redirect('/profile/'.$request);
        }
    }

    public function show(){
        $userid = Auth::user()->id;
        $user = User::find($userid);
        $profile = $user->profile;
        
        return view('friends/friendslist', ['user'=>$user, 'profile'=>$profile]);
    }

    public function myfriends(){
        $userid = Auth::user()->id;
        $list1 = Friend::where('friend_id', $userid)->where('accepted', 1)->pluck('user_id');
        $list2 = Friend::where('user_id', $userid)->where('accepted', 1)->pluck('friend_id');
        $friends = User::whereIn('id', $list1)->orWhereIn('id', $list2)->get();
        return view('friends/myfriends', ['friends'=>$friends]);
    }

    public function received(){
        $userid = Auth::user()->id;
        $list = Friend::where('friend_id', $userid)->where('accepted', 0)->pluck('user_id');
        $friends = User::whereIn('id', $list)->get();
        return view('friends/myfriends', ['friends'=>$friends]);
    }

    public function sent(){
        $userid = Auth::user()->id;
        $list = Friend::where('user_id', $userid)->where('accepted', 0)->pluck('friend_id');
        $friends = User::whereIn('id', $list)->get();
        return view('friends/myfriends', ['friends'=>$friends]);
    }

    public function others(){
        $userid = Auth::user()->id;
        $list1 = Friend::where('friend_id', $userid)->pluck('user_id');
        $list2 = Friend::where('user_id', $userid)->pluck('friend_id');
        $friends = User::whereNotIn('id', $list1)->whereNotIn('id', $list2)->where('id', '!=', $userid)->get();
        return view('friends/myfriends', ['friends'=>$friends]);
    }
}
