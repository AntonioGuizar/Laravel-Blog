<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 3; ++$i) {
            $this->execInBackground('wget https://picsum.photos/640/480 -O public/storage/images/categories/' . $i . '.jpg');
            \App\Models\Category::create([
                'name' => $faker->sentence,
                'description' => $faker->paragraph,
                'image_path' => 'images/categories/' . $i . '.jpg'
            ]);
        }
    }

    function execInBackground($cmd)
    {
        $cmd = escapeshellcmd($cmd);
        exec($cmd . " > /dev/null &");
    }

}
