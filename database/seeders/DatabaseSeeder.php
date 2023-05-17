<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Movie;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);

        User::factory()->create([
            'username' => 'admin',
            'slug' => 'admin',
            'email' => 'admin@admin.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role_id' => Role::ADMIN
        ]);

        User::factory()->count(5)->create();
        Movie::factory()->count(10)->create();
        Post::factory()->count(20)->create();

        User::factory()->create([
            'username' => 'batman',
            'slug' => 'batman',
            'email' => 'batman@batman.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role_id' => Role::USER
        ]);

        User::factory()->create([
            'username' => 'joker',
            'slug' => 'joker',
            'email' => 'joker@joker.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role_id' => Role::USER
        ]);

        Movie::factory()->create([
            'title' => 'Deset u pola', 
            'slug' => "deset-u-pola",
            'release_year' => 2022,
            'duration_minutes' => 90,
            'plot_summary' => 'U Sarajevu gdje...',
            'user_id' => 1
        ]);

        Movie::factory()->create([
            'title' => 'Zlatna dolina', 
            'slug' => "zlatna-dolina",
            'release_year' => 2008,
            'duration_minutes' => 90,
            'plot_summary' => 'Zlatna dolina je drugi naziv...',
            'user_id' => 1
        ]);

        Post::factory()->create([
            'title' => 'Deset u pola 2022',
            'review' => 'Ovo prica krece sto...',
            'rate' => 9.0,
            'user_id' => 1,
            'movie_id' => 11
        ]);

        Post::factory()->create([
            'title' => 'Zlatna dolina 2008',
            'review' => 'Ovo prica krece sto...',
            'rate' => 9.0,
            'user_id' => 1,
            'movie_id' => 12
        ]);
    }
}
