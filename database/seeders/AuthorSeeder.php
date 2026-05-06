<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Author::factory()->count(5)->trashed()->create();
        Author::factory()->count(15)->create();
        Author::factory()->ukraine()->create();
        Author::factory()->franko()->create();
    }
}
