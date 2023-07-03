<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Event;
use App\Models\Friend;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ColorTableSeeder::class);
        $this->call(GroupTableSeeder::class);
        User::factory(25)->create();
        Event::factory(300)->create();
        Friend::factory(100)->create();
    }
}
