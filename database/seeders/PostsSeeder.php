<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 5; ++$i) {
            // content is equal to 4 paragraphs of text separated by a line break
            $content = implode(' ', $faker->paragraphs(4));
            \App\Models\Post::create([
                'title' => $faker->sentence,
                'content' => $content,
                'author_id' => 1,
                'image_path' => $faker->imageUrl(640, 480, 'cats'),
            ]);
            $content = implode(' ', $faker->paragraphs(4));
            \App\Models\Post::create([
                'title' => $faker->sentence,
                'content' => $content,
                'author_id' => 2,
                'image_path' => $faker->imageUrl(640, 480, 'cats'),
            ]);
            $content = implode(' ', $faker->paragraphs(4));
            \App\Models\Post::create([
                'title' => $faker->sentence,
                'content' => $content,
                'author_id' => 3,
                'image_path' => $faker->imageUrl(640, 480, 'cats'),
            ]);
        }
    }
}
