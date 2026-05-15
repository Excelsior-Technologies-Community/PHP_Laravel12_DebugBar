<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Debugbar;
use App\Models\User;
use Exception;

class PageController extends Controller
{
    public function home()
    {
        Debugbar::startMeasure('user_count_timer');
        $usersCount = User::count();
        Debugbar::stopMeasure('user_count_timer');

        Debugbar::info("Total users: $usersCount");
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
        try {
            Debugbar::startMeasure('query_execution');
            $users = User::all();
            Debugbar::stopMeasure('query_execution');

            return view('pages.db-test', ['users' => $users, 'duration' => 0]);
        } catch (Exception $e) {
            Debugbar::addThrowable($e);
            return response('Error logged in Debugbar.');
        }
    }

    public function users()
    {
        $users = User::all();
        Debugbar::info('Users List page loaded');
        return view('pages.users', compact('users'));
    }

    public function ajaxView()
    {
        return view('pages.ajax-test');
    }

    public function ajaxData()
    {
        return response()->json([
            'status' => 'success',
            'users' => User::limit(5)->get()
        ]);
    }
}