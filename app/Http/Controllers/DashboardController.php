<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\UserLog;
use Debugbar;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index()
    {
        Debugbar::startMeasure('dashboard_metrics');
        
        // Get statistics with caching
        $stats = Cache::remember('dashboard_stats', 300, function () {
            Debugbar::info('Calculating dashboard statistics');
            
            return [
                'total_users' => User::count(),
                'total_posts' => Post::count(),
                'published_posts' => Post::where('is_published', true)->count(),
                'recent_logs' => UserLog::with('user')->latest()->take(10)->get(),
                'users_by_city' => User::select('city', DB::raw('count(*) as count'))
                    ->whereNotNull('city')
                    ->groupBy('city')
                    ->get(),
                'age_distribution' => User::select(
                        DB::raw('CASE 
                            WHEN age < 18 THEN "Under 18"
                            WHEN age BETWEEN 18 AND 30 THEN "18-30"
                            WHEN age BETWEEN 31 AND 50 THEN "31-50"
                            ELSE "50+"
                        END as age_group'),
                        DB::raw('count(*) as count')
                    )
                    ->whereNotNull('age')
                    ->groupBy('age_group')
                    ->get(),
                'posts_per_user' => User::withCount('posts')
                    ->orderBy('posts_count', 'desc')
                    ->limit(5)
                    ->get()
            ];
        });
        
        Debugbar::stopMeasure('dashboard_metrics');
        Debugbar::info('Dashboard loaded with statistics');
        
        return view('dashboard.index', $stats);
    }
}