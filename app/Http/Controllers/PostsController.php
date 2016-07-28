<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Like;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts.index')
            ->with('posts', $posts);
    }

    public function post(Request $request)
    {
        $this->validate($request, [
            'subject' => 'required|unique:posts,subject',
            'body' => 'required',
        ]);
        $post = Post::create($request->only(['subject', 'body']));
        return redirect()->back();
    }

    public function comment(Request $request, $postId)
    {
        $this->validate($request,[
            'body' => 'required',
        ]);
        Comment::create([
            'post_id' => $postId,
            'body' => $request->get('body'),
        ]);
        return redirect()->back();
    }

    public function likePost(Request $request, $postId)
    {
        $post = Post::findOrFail($postId);
        $post->likes()->save(new Like());
        return response()->json([
            'postId' => $postId,
            'count' => $post->likes()->count(),
        ]);
    }

    public function likeComment(Request $request, $commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $comment->likes()->save(new Like());
        return response()->json([
            'commentId' => $commentId,
            'count' => $comment->likes()->count(),
        ]);
    }
}
