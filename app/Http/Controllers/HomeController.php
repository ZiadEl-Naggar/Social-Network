<?php

namespace App\Http\Controllers;

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
        $user = Auth::user();
        $friends = $user->friends->where('accepted', 1)->toArray();
        // $friendsId = $friends->map(function ($friend) {
        //     return collect($friend->toArray())
        //         ->only(['friend_id'])
        //         ->all();
        // })->toArray();
        // dd($friends[0]['friend_id']);
        
        $friendsId = [];
        for ($i=0; $i < count($friends); $i++) { 
            array_push($friendsId, $friends[$i]['friend_id']);
        }
        
        $posts = Post::whereIn('user_id', $friendsId)->get();

        return view('home', ['posts'=>$posts]);
    }
}
