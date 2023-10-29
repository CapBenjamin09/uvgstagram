<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function __construct(){
    }

    public function index(User $user) {

        $posts = Post::where('user_id', $user->id)->paginate(4);

        return view('profile', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'required',
        ]);

        $request->user()->posts()->create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image,
        ]);

        return redirect()->route('post.index', auth()->user()->username);
    }

    public function show(User $user, Post $post)
    {
        $comments = Comment::where('post_id', $post->id)->get();
        return view('post.show', compact('user', 'post', 'comments'));
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $image_path = public_path('uploads/' . $post->image);
        $post->delete();

        if (File::exists($image_path)) {
            unlink($image_path);
        }
        return redirect()->route('post.index', auth()->user()->username);
    }

}
