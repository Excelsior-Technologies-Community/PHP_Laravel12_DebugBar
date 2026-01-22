# PHP_Laravel12_DebugBar


## Project Description

The PHP_Laravel12_DebugBar project is a simple Laravel 12 web application designed to demonstrate the use of Laravel Debugbar for debugging and monitoring your application. It includes basic pages, database testing, and integration with Laravel Debugbar to visualize queries, logs, and performance metrics directly in the browser.

This project is ideal for Laravel beginners who want to learn how to integrate Debugbar and inspect application behavior, database queries, and request lifecycle in real-time.


## Features

Laravel Debugbar Integration: Easily track database queries, log messages, and application performance.

Multiple Pages: Home, About, Contact, and DB Test pages.

Database Testing: Display all users from the database via Debugbar.

Bootstrap UI: Clean and responsive layout using Bootstrap 5.

Easy-to-Understand Structure: Ideal for learning Laravel basics and debugging.


## Pages Overview

Home Page: Displays a welcome message.

About Page: Provides information about the project.

Contact Page: Simple contact page example.

DB Test Page: Fetches all records from the users table and logs them in Debugbar.



## Key Technologies

Laravel 12

PHP 8.2

MySQL

Laravel Debugbar

Bootstrap 5

---



# Project SetUp

---

## STEP 1: Create New Laravel 12 Project

### Run Command :

```
composer create-project laravel/laravel PHP_Laravel12_DebugBar "12.*"

```

### Go inside project:

```
cd PHP_Laravel12_DebugBar

```

Make sure Laravel 12 is installed successfully.




## STEP 2: Install Debugbar

### Run:

```
composer require barryvdh/laravel-debugbar --dev

```

### Publish configuration:

```
php artisan vendor:publish --provider="Barryvdh\Debugbar\ServiceProvider"

```




## STEP 3: Database Configuration and enable Debugbar:

### Open .env file and update database credentials:

```

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=debugbar_test
DB_USERNAME=root
DB_PASSWORD=



APP_ENV=local
APP_DEBUG=true
DEBUGBAR_ENABLED=true



```

### Create database:

```
debugbar_test

```

### Then run migrations:

```
php artisan migrate

```




## STEP 4: Create Controller

### Run:

```
php artisan make:controller PageController

```

### Edit app/Http/Controllers/PageController.php:

```

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Debugbar;
use DB;

class PageController extends Controller
{
    public function home()
    {
        Debugbar::info('Home page loaded');
        return view('pages.home');
    }

    public function about()
    {
        Debugbar::info('About page loaded');
        return view('pages.about');
    }

    public function contact()
    {
        Debugbar::info('Contact page loaded');
        return view('pages.contact');
    }

    public function dbTest()
    {
        $users = DB::table('users')->get();
        Debugbar::info($users); // Shows queries
        return 'Check Debugbar for DB queries!';
    }
}

```


## STEP 5: Setup Routes

### Edit routes/web.php:

```

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/db-test', [PageController::class, 'dbTest'])->name('db-test');

```




## STEP 5: Create Blade Layout

### resources/views/layouts/app.blade.php:

```

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Debugbar Example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">DebugbarApp</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('db-test') }}">DB Test</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    @yield('content')
</div>

<footer class="bg-dark text-white text-center p-3 mt-5">
    &copy; 2026 Laravel Debugbar Example
</footer>
</body>
</html>

```

## STEP 7: Create Pages

### Home Page

resources/views/pages/home.blade.php:

```

@extends('layouts.app')

@section('content')
<h1 class="text-center">Home Page</h1>
<p class="text-center">Welcome to Laravel Debugbar Example.</p>
@endsection

```

### About Page

resources/views/pages/about.blade.php:

```

@extends('layouts.app')

@section('content')
<h1 class="text-center">About Page</h1>
<p class="text-center">This is a sample about page to test Debugbar.</p>
@endsection

```

### Contact Page

resources/views/pages/contact.blade.php:

```

@extends('layouts.app')

@section('content')
<h1 class="text-center">Contact Page</h1>
<p class="text-center">This is a sample contact page to test Debugbar.</p>
@endsection

```



## STEP 8: Clear Cache

### Run:

```
php artisan config:clear
php artisan cache:clear
php artisan route:clear

```

## STEP 10: Running the App

### Finally run the development server:

```
php artisan serve

```

### Visit in browser:

```
http://localhost:8000

```


## So You can see this type Output:


### Home Page:


<img width="1919" height="970" alt="Screenshot 2026-01-21 124127" src="https://github.com/user-attachments/assets/0a33badf-e993-418f-a304-88061639a428" />


### About Page:


<img width="1915" height="971" alt="Screenshot 2026-01-21 124159" src="https://github.com/user-attachments/assets/bf6ca4cb-fd8b-4545-81fb-7afa4f145feb" />


### Contact Page:


<img width="1916" height="971" alt="Screenshot 2026-01-21 124210" src="https://github.com/user-attachments/assets/97ea918e-9dd8-4909-830e-5f45e83b8987" />


### DB-test Page:


<img width="1919" height="972" alt="Screenshot 2026-01-21 124218" src="https://github.com/user-attachments/assets/49c936ae-4204-4dc3-b3e8-d9e722597aa9" />


### and also show this type:


<img width="1904" height="539" alt="Screenshot 2026-01-21 132330" src="https://github.com/user-attachments/assets/286999a8-5b55-41b0-9a90-0e4967d3e3f6" />

<img width="1911" height="565" alt="Screenshot 2026-01-21 132338" src="https://github.com/user-attachments/assets/a51834f1-66dd-4354-9c0d-30a644cc83a1" />

<img width="1919" height="546" alt="Screenshot 2026-01-21 132356" src="https://github.com/user-attachments/assets/40ea827b-83d4-408c-9ddd-be2a4e34bb58" />


---


# Project Folder Structure:

```

PHP_Laravel12_DebugBar/
├─ app/
│  └─ Http/
│     └─ Controllers/
│        └─ PageController.php
├─ resources/
│  └─ views/
│     ├─ layouts/
│     │  └─ app.blade.php
│     └─ pages/
│        ├─ home.blade.php
│        ├─ about.blade.php
│        └─ contact.blade.php
├─ routes/
│  └─ web.php
├─ config/
│  └─ debugbar.php
├─ .env
└─ composer.json

```

