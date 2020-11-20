<?php

namespace App\Http\Controllers;

use App\Models\React;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReactController extends Controller
{
    public function store(Request $request){
        $user_id = Auth::user()->id;
        if($react = React::where('post_id', $request->postid)->where('user_id', $user_id)->first()){
            if($react->react == $request->react){
                $react->react = "";
                $result = 'remove';
                $old = '';
            } else {
                $old = $react->react;
                $react->react = $request->react;
                $result = $request->react;
            }
            $react->save();
        } else {
            $react = new React();
            $react->user_id = $user_id;
            $react->post_id = $request->postid;
            $react->react = $request->react;
            $react->save();
            $result = $request->react;
            $old = '';
        }
        return response()->json([
            'result' => $result,
            'old' => $old,
        ]);
    }
}
