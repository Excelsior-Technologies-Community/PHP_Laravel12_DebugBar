@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4"><i class="fas fa-memory"></i> Cache Monitor</h1>
    
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Cache Status</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr><th>Cache Key</th><th>Status</th><th>Action</th></tr>
                        </thead>
                        <tbody>
                            @foreach($cacheStatus as $key => $status)
                            <tr>
                                <td><code>{{ $key }}</code></td>
                                <td>
                                    @if($status)
                                        <span class="badge bg-success">Cached</span>
                                    @else
                                        <span class="badge bg-secondary">Not Cached</span>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('cache.clear') }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="key" value="{{ $key }}">
                                        <button type="submit" class="btn btn-sm btn-danger">Clear</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Clear All Cache</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('cache.clear') }}" method="POST">
                        @csrf
                        <input type="hidden" name="key" value="all">
                        <button type="submit" class="btn btn-danger btn-lg w-100" onclick="return confirm('This will clear ALL cache. Continue?')">
                            <i class="fas fa-trash-alt"></i> Clear All Cache
                        </button>
                    </form>
                    <p class="text-muted mt-3 small">
                        <i class="fas fa-info-circle"></i> Clearing cache will force fresh database queries on next request.
                    </p>
                </div>
            </div>
            
            <div class="card mt-3">
                <div class="card-header">
                    <h5>Cache Information</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Default Cache Driver:</strong>
                            <span class="badge bg-info">{{ config('cache.default') }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Cache Prefix:</strong>
                            <span class="badge bg-secondary">{{ config('cache.prefix') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection