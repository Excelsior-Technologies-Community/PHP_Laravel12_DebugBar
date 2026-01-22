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
