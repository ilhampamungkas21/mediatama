<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\ModelVideo;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@mediatama.com',
            'level' => 'admin',
            'password' => Hash::make('secret')
        ]);

        User::factory()->create([
            'name' => 'customer2',
            'email' => 'cust2@gmail.com',
            'level' => 'customer',
            'password' => Hash::make('customer123')
        ]);

        ModelVideo::factory()->create([
            'name_video' => 'video 1',
            'url_video' => 'ixKg_bBdO-0',
        ]);

        ModelVideo::factory()->create([
            'name_video' => 'video 2',
            'url_video' => 'MPqft_YO3TA',
        ]);

        ModelVideo::factory()->create([
            'name_video' => 'video 3',
            'url_video' => 'ob6AgYDgjDY',
        ]);
    }
}
