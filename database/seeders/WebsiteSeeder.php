<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('websites')->insert([
            [
                'id' => 1,
                'title' => 'TestWebsite1',
                'link' => 'TestWebsite1.com',
            ],
            [
                'id' => 2,
                'title' => 'TestWebsite2',
                'link' => 'TestWebsite2.com',
            ],
            [
                'id' => 3,
                'title' => 'TestWebsite3',
                'link' => 'TestWebsite3.com',
            ]
        ]);
    }
}
