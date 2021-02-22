<?php

use Illuminate\Database\Seeder;
use App\Post;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 10; $i++) { 
            $newPost = new Post();
            $newPost->title = $faker->sentence();
            $newPost->slug = Str::slug($newPost->title);
            $newPost->subtitle = $faker->sentence();
            $newPost->text = $faker->text();
            $newPost->author = $faker->name;
            $newPost->img_path = $faker->imageUrl(640, 480, "nature");
            $newPost->publication_date = $faker->dateTime();
            $newPost->save();
        }
    }
}
