<?php

namespace App\Http\Controllers;

use App\Models\Friend;
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
}
