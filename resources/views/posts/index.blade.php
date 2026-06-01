@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-newspaper"></i> Posts Management</h1>
        <a href="{{ route('posts.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Create New Post
        </a>
    </div>
    
    @if($posts->count() > 0)
        <div class="row">
            @foreach($posts as $post)
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">
                            By {{ $post->user->name }} | {{ $post->created_at->diffForHumans() }}
                        </h6>
                        <p class="card-text">{{ Str::limit($post->content, 150) }}</p>
                        <div class="mt-2">
                            <span class="badge bg-{{ $post->is_published ? 'success' : 'secondary' }}">
                                {{ $post->is_published ? 'Published' : 'Draft' }}
                            </span>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent">
                        <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this post?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    @else
        <div class="alert alert-info">No posts found. <a href="{{ route('posts.create') }}">Create your first post</a></div>
    @endif
</div>
@endsection