<?php

use Illuminate\Database\Seeder;

class AboutContentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('about_contents')->insert([
            [
                'image_path' => '/img/welcome-2.png',
                'title' => 'Tentang Pemilik',
                'content' => json_encode('Profile'),
                'is_class' => false,
            ],
            [
            	'image_path' => '/img/welcome-1.jpg',
            	'title' => 'Ikebana Ikenobo',
            	'content' => json_encode('Class'),
            	'is_class' => true,
            ],
            [
            	'image_path' => '/img/welcome-1.jpg',
            	'title' => 'Handicraft',
            	'content' => json_encode('Class'),
            	'is_class' => true,
            ],
        ]);
    }
}
