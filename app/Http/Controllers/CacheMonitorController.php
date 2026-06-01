<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Debugbar;

class CacheMonitorController extends Controller
{
    public function index()
    {
        $cacheKeys = [
            'all_users',
            'dashboard_stats',
            'recent_posts'
        ];
        
        $cacheStatus = [];
        foreach ($cacheKeys as $key) {
            $cacheStatus[$key] = Cache::has($key);
        }
        
        Debugbar::info('Cache monitor loaded');
        
        return view('cache.index', compact('cacheStatus'));
    }
    
    public function clear(Request $request)
    {
        $key = $request->input('key');
        
        if ($key && $key !== 'all') {
            Cache::forget($key);
            Debugbar::info('Cache cleared for key: ' . $key);
            $message = "Cache for '$key' cleared successfully!";
        } elseif ($key === 'all') {
            Cache::flush();
            Debugbar::warning('ALL cache cleared!');
            $message = "All cache cleared successfully!";
        } else {
            return back()->with('error', 'Invalid cache key');
        }
        
        return back()->with('success', $message);
    }
}