@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-warning">
                    <h4 class="mb-0"><i class="fas fa-bolt"></i> Event System Test</h4>
                </div>
                <div class="card-body">
                    <p class="alert alert-info">
                        <i class="fas fa-info-circle"></i> This page demonstrates Laravel's event system.
                        Check the <strong>"Events"</strong> tab in Debugbar to see the fired events!
                    </p>
                    
                    <div class="text-center">
                        <button id="testEventBtn" class="btn btn-primary btn-lg">
                            <i class="fas fa-play"></i> Trigger Test Event
                        </button>
                    </div>
                    
                    <div id="eventResult" class="mt-4"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('testEventBtn').addEventListener('click', function() {
    const resultDiv = document.getElementById('eventResult');
    resultDiv.innerHTML = '<div class="alert alert-success">Event triggered! Check the Debugbar "Events" tab.</div>';
    
    // Make an AJAX call to trigger event
    fetch('/event-test-page');
    
    setTimeout(() => {
        resultDiv.innerHTML = '';
    }, 3000);
});
</script>
@endsection