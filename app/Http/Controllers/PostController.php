<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('posts.index', ['posts' => $posts]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function destroy($id)
    {
        $post = Post::find($id);

        $post->delete();

        return redirect()->route('post.index');
    }

    public function edit($id)
    {
        $post = Post::find($id);

        return view('posts.edit', ['post' => $post]);
    }

    public function search(Request $request)
    {
        $value = $request->input('search');
        
        $posts = Post::where('title', 'like', '%' . $value . '%')
            ->orWhere('content', 'like', '%' . $value . '%')
            ->orWhereHas('author', function ($authorQuery) use ($value) {
                $authorQuery->where('name', 'like', '%' . $value . '%');
            })
            ->get();

        return view('posts.index', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return redirect()->route('post.index');
        }
        
        return view('posts.show', ['post' => $post]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255|min:10',
            'content' => 'required|min:50'
        ]);
     
        $faker = \Faker\Factory::create();
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'image_path' => $faker->imageUrl(640, 480),
            'author_id' => auth()->user()->id
        ]);

        return redirect()->route('post.show', ['id' => $post->id]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255|min:10',
            'content' => 'required|min:50'
        ]);

        $post = Post::find($id);
        $post->title = $request->title;
        $post->content = $request->content;

        $post->save();

        return redirect()->route('post.show', ['id' => $post->id]);
    }
}
