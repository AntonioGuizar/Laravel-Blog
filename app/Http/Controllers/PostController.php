<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Post;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        $search = $request->input('search');
        $lastPosts = Post::orderBy('created_at', 'desc')->take(3)->get();
        $categories = Category::all();
        $data = [
            'posts' => $posts,
            'search' => $search,
            'lastPosts' => $lastPosts,
            'categories' => $categories
        ];
        return view('posts.index', $data);
    }

    public function create()
    {
        $categories = Category::all();
        return view('posts.create', ['categories' => $categories]);
    }

    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return redirect()->route('post.index');
        }

        try {
            Storage::delete('images/posts/' . $post->image_path);
            $post->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting post');
        }

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

        $search = $request->input('search');
        $lastPosts = Post::orderBy('created_at', 'desc')->take(3)->get();
        $categories = Category::all();

        $data = [
            'posts' => $posts,
            'search' => $search,
            'lastPosts' => $lastPosts,
            'categories' => $categories
        ];

        return view('posts.index', $data);
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
            'summary' => 'required|min:50',
            'content' => 'required|min:50'
        ]);

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);
            $filePath = Storage::disk('public')->put('images/posts', $request->file('image'));
            if (!$filePath) {
                return redirect()->back()->with('error', 'Error uploading image');
            }
        }
     
        $post = Post::create([
            'title' => $request->title,
            'summary' => $request->summary,
            'content' => $request->content,
            'category_id' => 1,
            'image_path' => $filePath ?? null,
            'author_id' => auth()->user()->id
        ]);

        if (!$post) {
            return redirect()->back()->with('error', 'Error creating post');
        }

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

    public function postsByCategory($id)
    {
        $posts = Post::where('category_id', $id)->get();
        $lastPosts = Post::orderBy('created_at', 'desc')->take(3)->get();
        $categories = Category::all();
        $data = [
            'posts' => $posts,
            'lastPosts' => $lastPosts,
            'categories' => $categories
        ];
        return view('posts.index', $data);
    }
}
