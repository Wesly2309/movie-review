<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Movie::create([
            "title" => "laravel",
            "description" => "Laravel is a PHP Framework , user can use the laravel and read the documentation",
            "rating_star"=> 6,
            "image" => "https://logique.s3.ap-southeast-1.amazonaws.com/2020/10/laravel-8.jpg"
        ]);
    }
}
