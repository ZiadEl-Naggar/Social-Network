<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userid = Auth::user()->id;
        $list1 = Friend::where('friend_id', $userid)->where('accepted', 1)->pluck('user_id');
        $list2 = Friend::where('user_id', $userid)->where('accepted', 1)->pluck('friend_id');
        $posts = Post::whereIn('user_id', $list1)->orWhereIn('user_id', $list2)->orWhere('user_id', $userid)->orderBy('id', 'DESC')->get();
        

        return view('home', ['posts'=>$posts]);
    }
}
