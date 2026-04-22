@extends('layouts.app')

@section('content')
<h1 class="text-center">DB Test Page</h1>
<p class="text-center text-muted">Check Debugbar for queries and query duration!</p>

@if($users->isEmpty())
    <div class="alert alert-warning text-center mt-4">
        No users found in the database.
    </div>
@else
    <table class="table table-bordered mt-4">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

<p class="text-center mt-3 text-muted">
    Query executed in {{ round($duration, 4) }} seconds
</p>
@endsection