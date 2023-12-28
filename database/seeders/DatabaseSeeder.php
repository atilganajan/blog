<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $categories = array(
            "Technology",
            "Health and Wellness",
            "Travel and Exploration",
            "Fashion and Style",
            "Education and Learning",
            "Personal Development",
            "Finance and Investment",
            "Arts and Culture",
            "Book and Literature",
            "Movie and TV Show Reviews",
            "Nutrition and Recipes",
            "Nature and Environment",
            "Sports and Exercise",
            "Pets and Animals",
            "Parenting and Family",
        );

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
            ]);
        }

    }
}
