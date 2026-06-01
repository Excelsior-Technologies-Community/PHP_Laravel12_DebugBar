@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4"><i class="fas fa-chart-line"></i> Analytics Dashboard</h1>
    
    <!-- Stats Cards -->
    <div class="row">
        <div class="col-md-3 mb-3">
            <div class="card bg-primary text-white card-hover">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <h2 class="mb-0">{{ $total_users }}</h2>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="card bg-success text-white card-hover">
                <div class="card-body">
                    <h5 class="card-title">Total Posts</h5>
                    <h2 class="mb-0">{{ $total_posts }}</h2>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="card bg-info text-white card-hover">
                <div class="card-body">
                    <h5 class="card-title">Published Posts</h5>
                    <h2 class="mb-0">{{ $published_posts }}</h2>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="card bg-warning text-white card-hover">
                <div class="card-body">
                    <h5 class="card-title">Publishing Rate</h5>
                    <h2 class="mb-0">
                        {{ $total_posts > 0 ? round(($published_posts / $total_posts) * 100, 1) : 0 }}%
                    </h2>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <!-- Users by City -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-city"></i> Users by City</h5>
                </div>
                <div class="card-body">
                    @if($users_by_city->count() > 0)
                        <ul class="list-group">
                            @foreach($users_by_city as $city)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $city->city ?: 'Not specified' }}
                                    <span class="badge bg-primary rounded-pill">{{ $city->count }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">No city data available</p>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Age Distribution -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-chart-pie"></i> Age Distribution</h5>
                </div>
                <div class="card-body">
                    @if($age_distribution->count() > 0)
                        <ul class="list-group">
                            @foreach($age_distribution as $age)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $age->age_group }}
                                    <span class="badge bg-success rounded-pill">{{ $age->count }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">No age data available</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <!-- Top Users -->
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-trophy"></i> Top 5 Users by Posts</h5>
                </div>
                <div class="card-body">
                    @if($posts_per_user->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Rank</th>
                                        <th>User Name</th>
                                        <th>Email</th>
                                        <th>Posts Count</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($posts_per_user as $index => $user)
                                    <tr>
                                        <td>
                                            @if($index == 0) 🥇
                                            @elseif($index == 1) 🥈
                                            @elseif($index == 2) 🥉
                                            @else {{ $index + 1 }}
                                            @endif
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <span class="badge bg-info">{{ $user->posts_count }} posts</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted">No posts data available</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <!-- Recent Activity -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-clock"></i> Recent Activity Logs</h5>
        </div>
        <div class="card-body">
            @if($recent_logs->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Action</th>
                                <th>IP Address</th>
                                <th>Time</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recent_logs as $log)
                            <tr>
                                <td>{{ $log->user->name }}</td>
                                <td>
                                    <span class="badge bg-{{ $log->action == 'created' ? 'success' : ($log->action == 'updated' ? 'warning' : 'danger') }}">
                                        {{ $log->action }}
                                    </span>
                                </td>
                                <td>{{ $log->ip_address }}</td>
                                <td>{{ $log->created_at->diffForHumans() }}</td>
                                <td>
                                    @if($log->details)
                                        <button class="btn btn-sm btn-info" onclick="alert('{{ addslashes($log->details) }}')">
                                            View
                                        </button>
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted">No recent activity</p>
            @endif
        </div>
    </div>
</div>
@endsection