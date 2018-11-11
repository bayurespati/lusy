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
                'page_name' => 'Home',
                'image_path' => NULL,
            ],
            [
                'page_name' => 'About',
                'image_path' => NULL,
            ],
            [
                'page_name' => 'Gallery',
                'image_path' => NULL,
            ],
            [
                'page_name' => 'Event & Activities',
                'image_path' => NULL,
            ],
            [
                'page_name' => 'Shop',
                'image_path' => NULL,
            ],
            [
                'page_name' => 'Contact',
                'image_path' => NULL,
            ],
        ]);
    }
}
