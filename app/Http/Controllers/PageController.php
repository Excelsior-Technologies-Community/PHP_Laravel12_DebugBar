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
    public function performance()
{
    Debugbar::startMeasure('page_load');
    
    // Simulate some heavy operations
    sleep(1); // Simulate processing time
    
    // Get PHP info
    $phpInfo = [
        'version' => phpversion(),
        'memory_limit' => ini_get('memory_limit'),
        'max_execution_time' => ini_get('max_execution_time'),
        'upload_max_filesize' => ini_get('upload_max_filesize')
    ];
    
    Debugbar::stopMeasure('page_load');
    Debugbar::info('Performance page loaded');
    
    return view('pages.performance', compact('phpInfo'));
}

public function eventTest()
{
    Debugbar::startMeasure('event_test');
    
    // Trigger events for testing
    event(new \App\Events\UserAction('test_event', 'Performance page visited'));
    
    Debugbar::stopMeasure('event_test');
    Debugbar::info('Event test page loaded');
    
    return view('pages.event-test');
}
public function eventTestPage()
{
    event(new \App\Events\UserAction('test_event', 'Event test page visited'));
    return response()->json(['status' => 'Event triggered']);
}
}