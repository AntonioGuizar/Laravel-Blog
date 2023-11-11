<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => "Antonio Guizar",
            'email' => "juanantonioguizardiaz@gmail.com",
            'password' => bcrypt('$Gu1z4r$'),
        ]);
    }
}
