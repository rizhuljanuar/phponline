<?php

declare(strict_types=1);

namespace Database\Seeders;

use Domain\Blogging\Models\Post;
use Domain\Shared\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // if (app()->environment('local')) {
        //     $this->call(
        //         DefaultUserSeeder::class,
        //     );
        // }

        // Post::factory()->count(20)->for(
        //     User::factory()->create([
        //         'first_name' => 'Rizhul',
        //         'last_name' => 'Januar Ramadhan',
        //         'email' => 'rayjam66@gmail.com',
        //     ])
        // )->create();

        User::create([
            'first_name' => 'Rizhul',
            'last_name' => 'Januar Ramadhan',
            'email' => 'rayjam66@gmail.com',
            'password' => 'password'
        ]);
    }
}
