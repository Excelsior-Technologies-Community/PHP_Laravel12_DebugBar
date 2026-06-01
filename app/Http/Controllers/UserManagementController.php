<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserLog;
use Debugbar;
use DB;
use Illuminate\Support\Facades\Cache;

class UserManagementController extends Controller
{
    public function index()
    {
        Debugbar::startMeasure('user_list_query');
        
        // Cache users for 5 minutes
        $users = Cache::remember('all_users', 300, function () {
            Debugbar::info('Fetching users from database (cache miss)');
            return User::withCount('posts')->get();
        });
        
        Debugbar::stopMeasure('user_list_query');
        Debugbar::info('Total users loaded: ' . $users->count());
        
        return view('users.index', compact('users'));
    }

    public function create()
    {
        Debugbar::info('User creation form loaded');
        return view('users.create');
    }

    public function store(Request $request)
    {
        Debugbar::startMeasure('user_creation');
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'age' => 'nullable|integer|min:1|max:150',
            'city' => 'nullable|string|max:100',
            'password' => 'required|min:6'
        ]);
        
        DB::beginTransaction();
        
        try {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'age' => $validated['age'],
                'city' => $validated['city'],
                'password' => bcrypt($validated['password'])
            ]);
            
            // Log the action
            UserLog::create([
                'user_id' => $user->id,
                'action' => 'created',
                'ip_address' => $request->ip(),
                'details' => json_encode($validated)
            ]);
            
            DB::commit();
            
            // Clear cache
            Cache::forget('all_users');
            
            Debugbar::stopMeasure('user_creation');
            Debugbar::info('New user created: ' . $user->name);
            
            return redirect()->route('users.manage.index')
                ->with('success', 'User created successfully!');
                
        } catch (\Exception $e) {
            DB::rollBack();
            Debugbar::addThrowable($e);
            return back()->with('error', 'Failed to create user: ' . $e->getMessage());
        }
    }

    public function edit(User $user)
    {
        Debugbar::info('Editing user: ' . $user->name);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        Debugbar::startMeasure('user_update');
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'nullable|integer|min:1|max:150',
            'city' => 'nullable|string|max:100'
        ]);
        
        DB::beginTransaction();
        
        try {
            $user->update($validated);
            
            UserLog::create([
                'user_id' => $user->id,
                'action' => 'updated',
                'ip_address' => $request->ip(),
                'details' => json_encode($validated)
            ]);
            
            DB::commit();
            Cache::forget('all_users');
            
            Debugbar::stopMeasure('user_update');
            Debugbar::info('User updated: ' . $user->name);
            
            return redirect()->route('users.manage.index')
                ->with('success', 'User updated successfully!');
                
        } catch (\Exception $e) {
            DB::rollBack();
            Debugbar::addThrowable($e);
            return back()->with('error', 'Failed to update user');
        }
    }

    public function destroy(Request $request, User $user)
    {
        Debugbar::startMeasure('user_deletion');
        
        DB::beginTransaction();
        
        try {
            UserLog::create([
                'user_id' => $user->id,
                'action' => 'deleted',
                'ip_address' => $request->ip(),
                'details' => json_encode(['deleted_at' => now()])
            ]);
            
            $userName = $user->name;
            $user->delete();
            
            DB::commit();
            Cache::forget('all_users');
            
            Debugbar::stopMeasure('user_deletion');
            Debugbar::warning('User deleted: ' . $userName);
            
            return redirect()->route('users.manage.index')
                ->with('success', 'User deleted successfully!');
                
        } catch (\Exception $e) {
            DB::rollBack();
            Debugbar::addThrowable($e);
            return back()->with('error', 'Failed to delete user');
        }
    }

    public function logs(User $user)
    {
        Debugbar::info('Viewing logs for user: ' . $user->name);
        $logs = $user->logs()->latest()->get();
        return view('users.logs', compact('user', 'logs'));
    }
}