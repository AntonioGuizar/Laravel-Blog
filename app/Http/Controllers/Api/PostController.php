<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        return Post::all();
    }

    public function store(Request $request)
    {
        $post = Post::create($request->all());

        return response()->json($post, 201);
    }

    public function show($id)
    {
        $post = Post::find($id);
        
        return response()->json($post);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        
        $post->update($request->all());

        return response()->json($post);
    }

    public function destroy($id)
    {
        // Check if a session exists and if a user is logged in
        if (auth()->check()) {
            $post = Post::find($id);

            // Check if the user is the author of the post
            if (auth()->user()->id === $post->author_id) {
                $post->delete();
                return response()->json(null, 204);
            } else {
                return response()->json(['message' => 'Unauthorized'], 401);
            }
        } else {
            return response()->json(['message' => 'User not authenticated'], 401);
        }
    }
}
