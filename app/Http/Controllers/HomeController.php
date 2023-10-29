<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::all()->sortDesc();
//        $comments = Comment::where('post_id', $posts->id)->get();
        return view('home', compact('posts'));
    }

}
