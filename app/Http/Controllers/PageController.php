<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Debugbar;
use DB;
use App\Models\User;

class PageController extends Controller
{
    // Home Page with total users count in Debugbar
    public function home()
    {
        $usersCount = User::count();
        Debugbar::info("Total users: $usersCount");
        Debugbar::info('Home page loaded');
        return view('pages.home');
    }

    // About Page
    public function about()
    {
        Debugbar::info('About page loaded');
        return view('pages.about');
    }

    // Contact Page
    public function contact()
    {
        Debugbar::info('Contact page loaded');
        return view('pages.contact');
    }

    // DB Test Page with query duration
    public function dbTest()
    {
        $start = microtime(true);
        $users = DB::table('users')->get();
        $duration = microtime(true) - $start;
        
        // Optional: keep query duration logged
        Debugbar::info("DB query took {$duration} seconds");

        return view('pages.db-test', compact('users', 'duration'));
    }
    // New Users List Page
    public function users()
    {
        $users = DB::table('users')->get();
        Debugbar::info('Users List page loaded');
        return view('pages.users', compact('users'));
    }
}
