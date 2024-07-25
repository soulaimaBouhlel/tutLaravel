<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Category::truncate();
        Post::truncate();


//        Post::factory()->create();
        $categories = Category::factory()->count(5)->create();
        $writers = User::factory()->count(6)->create();

        Post::factory()->count(20)->make()->each(function ($post) use ($categories, $writers) {
            $post->category_id = $categories->random()->id;
            $post->user_id = $writers->random()->id;
            $post->save();
        });

    }
}
