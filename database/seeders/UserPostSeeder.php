<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\UserLog;
use Illuminate\Support\Facades\Hash;

class UserPostSeeder extends Seeder
{
    public function run(): void
    {
        // Create 10 users
        $users = User::factory(10)->create();
        
        // Create posts for each user
        foreach ($users as $user) {
            Post::factory(3)->create(['user_id' => $user->id]);
            
            // Create logs
            UserLog::create([
                'user_id' => $user->id,
                'action' => 'created',
                'ip_address' => '127.0.0.1',
                'details' => json_encode(['seeded' => true])
            ]);
        }
    }
}