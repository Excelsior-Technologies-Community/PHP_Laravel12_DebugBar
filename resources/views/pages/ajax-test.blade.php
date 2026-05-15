@extends('layouts.app')

@section('content')
<div class="container text-center">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Ajax Request Debugging</h4>
                </div>
                <div class="card-body">
                    <p class="text-muted">Click the button below to fetch users via an asynchronous Ajax request and track it in Laravel Debugbar.</p>
                    
                    <button id="loadData" class="btn btn-success mt-2">
                        <span id="btnText">Fetch Users via Ajax</span>
                        <span id="btnLoader" class="spinner-border spinner-border-sm d-none" role="status"></span>
                    </button>
                    
                    <div id="result" class="mt-4 text-start">
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('loadData').addEventListener('click', function() {
    const btnText = document.getElementById('btnText');
    const btnLoader = document.getElementById('btnLoader');
    const resultDiv = document.getElementById('result');
    const loadBtn = document.getElementById('loadData');

    // Show Loader
    btnText.innerText = 'Loading...';
    btnLoader.classList.remove('d-none');
    loadBtn.disabled = true;

    fetch('/get-ajax-data')
        .then(response => response.json())
        .then(data => {
            let html = '<h5 class="mb-3">Latest Users:</h5><ul class="list-group shadow-sm">';
            
            // Note: 'users' comes from the PageController ajaxData response
            data.users.forEach(user => {
                html += `
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>${user.name}</strong><br>
                            <small class="text-muted">${user.email}</small>
                        </div>
                        <span class="badge bg-info rounded-pill">ID: ${user.id}</span>
                    </li>`;
            });
            
            html += '</ul>';
            resultDiv.innerHTML = html;

            // Reset Button
            btnText.innerText = 'Fetch Users via Ajax';
            btnLoader.classList.add('d-none');
            loadBtn.disabled = false;

            // Debugbar notification alert
            alert('Request completed successfully! You can now inspect the "Ajax" tab in Laravel Debugbar to see the queries and timeline for this request.');
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Something went wrong while fetching data.');
            
            btnText.innerText = 'Fetch Users via Ajax';
            btnLoader.classList.add('d-none');
            loadBtn.disabled = false;
        });
});
</script>
@endsection