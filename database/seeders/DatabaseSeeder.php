<?php

namespace Database\Seeders;

use App\Models\Follow;
use App\Models\Like;
use App\Models\Post;
use App\Models\Profile;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    //    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        //        User::factory()->create([
        //            'name' => 'Test User',
        //            'email' => 'test@example.com',
        //        ]);

        $profiles = Profile::factory(20)->create();

        foreach ($profiles as $profile) {
            Post::factory()->count(5)->create(['profile_id' => $profile->id]);

        }

        $posts = Post::all();

        foreach ($profiles as $profile) {
            $to_follow = $profiles->except($profile->id)->random(rand(3, 7));
            foreach ($to_follow as $target) {
                Follow::createFollow($profile, $target);
            }
        }

        foreach ($profiles as $profile) {
            $to_like = $posts->where('profile_id', '!=', $profile->id)->random(rand(10, 20));

            foreach ($to_like as $post) {
                Like::createLike($profile, $post);
            }
        }

        foreach ($profiles as $profile) {
            $to_repost = $posts->where('profile_id', '!=', $profile->id)->random(rand(2, 5));

            foreach ($to_repost as $post) {
                Post::repost($profile, $post, rand(0, 1) ? null : 'Great post!');
            }
        }

        for ($li = 0; $li < rand(20, 30); $li++) {
            $parent_post = $posts->random();
            $replies = $profiles->where('id', '!=', $parent_post->id)->random();

            Post::factory()->reply($parent_post)->create(['profile_id' => $replies->id]);
        }
    }
}
