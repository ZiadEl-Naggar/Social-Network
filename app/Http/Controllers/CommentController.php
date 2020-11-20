<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request){
        $comment = new Comment();
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $request->postid;
        $comment->comment = $request->comment;
        $comment->date = Carbon::now();
        $comment->save();
        $name = $comment->user->name;
        $userurl = url('/profile/'.$comment->user_id);
        $userimg = $comment->user->profile ? ($comment->user->profile->image ? $comment->user->profile->image : "/storage/uploads/pp.png") : "/storage/uploads/pp.png";
        return response()->json([
            'commentid' => $comment->id,
            'date' => $comment->date,
            'userid' => $comment->user_id,
            'name' => $name,
            'userurl' => $userurl,
            'userimg' => $userimg,
        ]);
    }

    public function destroy(Request $request){
        $comment = Comment::where('id', $request->commentid)->delete();
        return response()->json([
            'commentid' => $request->commentid,
        ]);
    }
}
