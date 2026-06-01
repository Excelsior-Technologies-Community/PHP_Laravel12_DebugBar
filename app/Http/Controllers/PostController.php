<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Debugbar;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        Debugbar::startMeasure('posts_query');
        
        $posts = Post::with('user')->latest()->paginate(10);
        
        Debugbar::stopMeasure('posts_query');
        Debugbar::info('Posts loaded: ' . $posts->total());
        
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $users = User::all();
        return view('posts.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'is_published' => 'boolean'
        ]);
        
        DB::beginTransaction();
        
        try {
            $post = Post::create($validated);
            DB::commit();
            
            Debugbar::info('New post created: ' . $post->title);
            
            return redirect()->route('posts.index')
                ->with('success', 'Post created successfully!');
                
        } catch (\Exception $e) {
            DB::rollBack();
            Debugbar::addThrowable($e);
            return back()->with('error', 'Failed to create post');
        }
    }

    public function edit(Post $post)
    {
        $users = User::all();
        return view('posts.edit', compact('post', 'users'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'is_published' => 'boolean'
        ]);
        
        $post->update($validated);
        
        Debugbar::info('Post updated: ' . $post->title);
        
        return redirect()->route('posts.index')
            ->with('success', 'Post updated successfully!');
    }

    public function destroy(Post $post)
    {
        $postTitle = $post->title;
        $post->delete();
        
        Debugbar::warning('Post deleted: ' . $postTitle);
        
        return redirect()->route('posts.index')
            ->with('success', 'Post deleted successfully!');
    }
}