<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderService;
use App\Models\Service;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'customer']);
        DB::transaction(function () {
            $admin = User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => bcrypt('password'),
            ]);
            $admin->assignRole('admin');
        });

        User::factory()
            ->count(10)
            ->create()
            ->each(function ($user) {
                $user->assignRole('customer');
            });
        Order::factory(30)->create();
        Service::factory(30)->create();
        OrderService::factory(30)->create();

    }
}
