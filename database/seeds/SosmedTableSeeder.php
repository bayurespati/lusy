<?php

use Illuminate\Database\Seeder;

class SosmedTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sosmeds')->insert([
            [
                'title' => 'Twitter',
                'icon_path' => '',
                'is_active' => true,
                'order' => 1,
                'link' => 'https://twitter.com/lusywahyudi',
            ],
            [
                'title' => 'Facebook',
                'icon_path' => '',
                'is_active' => true,
                'order' => 2,
                'link' => 'https://www.facebook.com/lusywahyudi2',
            ],
            [
                'title' => 'Instagram',
                'icon_path' => '',
                'is_active' => true,
                'order' => 3,
                'link' => 'https://www.instagram.com/p/_0MDGFhXhl/',
            ],
            [
                'title' => 'Pinterest',
                'icon_path' => '',
                'is_active' => true,
                'order' => 4,
                'link' => 'https://id.pinterest.com/LusyWahyudi/',
            ],
            [
                'title' => 'Flickr',
                'icon_path' => '',
                'is_active' => true,
                'order' => 5,
                'link' => 'https://www.flickr.com/photos/119227943@N07/',
            ],
        ]);
    }
}
