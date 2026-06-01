@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-history"></i> Activity Logs for {{ $user->name }}</h1>
        <a href="{{ route('users.manage.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Users
        </a>
    </div>
    
    <div class="card">
        <div class="card-body">
            @if($logs->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>IP Address</th>
                                <th>Details</th>
                                <th>Timestamp</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($logs as $log)
                            <tr>
                                <td>
                                    <span class="badge bg-{{ $log->action == 'created' ? 'success' : ($log->action == 'updated' ? 'warning' : 'danger') }}">
                                        {{ $log->action }}
                                    </span>
                                </td>
                                <td>{{ $log->ip_address }}</td>
                                <td>
                                    @if($log->details)
                                        <pre class="mb-0 small">{{ json_decode($log->details, true) ? json_encode(json_decode($log->details, true), JSON_PRETTY_PRINT) : $log->details }}</pre>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info">No logs found for this user.</div>
            @endif
        </div>
    </div>
</div>
@endsection