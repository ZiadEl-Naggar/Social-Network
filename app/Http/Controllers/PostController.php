<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'postcontent' => 'required_without:image',
            'image' => 'required_without:postcontent|max:1000',
        ], [
            'postcontent.required_without' => 'No post found',
            'image.required_without' => '',
            'image.mimes' => 'Image not valid',
            'image.max' => ' Image is too large',
        ]);

        $post = new Post();
        $post->user_id = Auth::user()->id;
        $post->content = $request->postcontent;
        if($request->image != null){
            $path = $request->image->store('/uploads', 'public');
            $url = Storage::url($path);
            $post->image = $url;
        }
        $post->privacy = $request->privacy;
        $post->date = Carbon::now();
        $post->save();
        return redirect(url('/profile/'.Auth::user()->id));
    }

    public function destroy(Request $request){
        $post = Post::where('id', $request->postid)->delete();
        return redirect(url('/profile/'.Auth::user()->id));
    }
}
