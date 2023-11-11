<?php

namespace Database\Seeders;

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
            $summary = implode(' ', $faker->sentences(3));
            $content = implode(' ', $faker->paragraphs(4));
            $this->execInBackground('wget https://picsum.photos/1280/480 -O public/storage/images/posts/' . $i . '.jpg');
            \App\Models\Post::create([
                'title' => $faker->sentence,
                'summary' => $summary,
                'content' => $content,
                'author_id' => 1,
                'category_id' => 1,
                'image_path' => 'images/posts/' . $i . '.jpg'
            ]);
        }
    }

    function execInBackground($cmd)
    {
        $cmd = escapeshellcmd($cmd);
        exec($cmd . " > /dev/null &");
    }
}
