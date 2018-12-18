<?php

use Illuminate\Database\Seeder;

class ImageConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('image_config')->insert([
            [
                'page_name' => 'Event Showcase Background in Home Page',
                'image_path' => '/img/upcoming-event-bg.jpg',
            ],
            // [
                // 'page_name' => 'About Page Banner',
                // 'image_path' => '/img/page-banner-bg.jpg',
            // ],
            // [
                // 'page_name' => 'Gallery Page Banner',
                // 'image_path' => '/img/page-banner-bg.jpg',
            // ],
            // [
                // 'page_name' => 'Event Page Banner',
                // 'image_path' => '/img/page-banner-bg.jpg',
            // ],
            // [
                // 'page_name' => 'Shop Page Banner',
                // 'image_path' => '/img/page-banner-bg.jpg',
            // ],
            // [
                // 'page_name' => 'Contact Page Banner',
                // 'image_path' => '/img/page-banner-bg.jpg',
            // ],
        ]);
    }
}
