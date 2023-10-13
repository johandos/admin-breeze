<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'seguridad web',
            'email' => 'seguridadweb@campusviu.es',
            'password' => bcrypt('S3gur1d4d?W3b'),
        ]);
    }
}
