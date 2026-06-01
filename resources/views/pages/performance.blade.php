@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4"><i class="fas fa-tachometer-alt"></i> Performance Monitoring</h1>
    
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">PHP Information</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>PHP Version:</th>
                            <td>{{ $phpInfo['version'] }}</td>
                        </tr>
                        <tr>
                            <th>Memory Limit:</th>
                            <td>{{ $phpInfo['memory_limit'] }}</td>
                        </tr>
                        <tr>
                            <th>Max Execution Time:</th>
                            <td>{{ $phpInfo['max_execution_time'] }} seconds</td>
                        </tr>
                        <tr>
                            <th>Upload Max Filesize:</th>
                            <td>{{ $phpInfo['upload_max_filesize'] }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Laravel Information</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Laravel Version:</th>
                            <td>{{ app()->version() }}</td>
                        </tr>
                        <tr>
                            <th>Environment:</th>
                            <td>{{ app()->environment() }}</td>
                        </tr>
                        <tr>
                            <th>Debug Mode:</th>
                            <td>
                                <span class="badge bg-{{ config('app.debug') ? 'danger' : 'success' }}">
                                    {{ config('app.debug') ? 'Enabled' : 'Disabled' }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Timezone:</th>
                            <td>{{ config('app.timezone') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Debugbar Performance Metrics</h5>
        </div>
        <div class="card-body">
            <p class="alert alert-info">
                <i class="fas fa-info-circle"></i> Check the Laravel Debugbar at the bottom of this page for detailed performance metrics including:
            </p>
            <ul>
                <li>Total execution time</li>
                <li>Memory usage</li>
                <li>Database query count and time</li>
                <li>Route loading time</li>
                <li>View rendering time</li>
            </ul>
            <hr>
            <p><strong>Note:</strong> This page intentionally includes a 1-second sleep to demonstrate Debugbar's timing capabilities.</p>
        </div>
    </div>
</div>
@endsection