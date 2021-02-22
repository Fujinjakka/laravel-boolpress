<?php

use Illuminate\Database\Seeder;
use App\InfoPost;
use App\Post;
use Faker\Generator as Faker;

class InfoPostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $posts = Post::all();
        foreach ($posts as $post) {
            $newInfoPosts = new InfoPost();
            $newInfoPosts->post_id = $post->id;
            $newInfoPosts->post_status = $faker->randomElement(["public", "private", "draft"]);
            $newInfoPosts->comment_status = $faker->randomElement(["open", "closed", "private"]);
            $newInfoPosts->save();
        }
    }
}
