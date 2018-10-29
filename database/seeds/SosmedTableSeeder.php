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
                'is_active' => false,
                'order' => 1,
                'link' => '',
            ],
            [
                'title' => 'Facebook',
                'icon_path' => '',
                'is_active' => false,
                'order' => 2,
                'link' => '',
            ],
            [
                'title' => 'Instagram',
                'icon_path' => '',
                'is_active' => false,
                'order' => 3,
                'link' => '',
            ],
            [
                'title' => 'Pinterest',
                'icon_path' => '',
                'is_active' => false,
                'order' => 4,
                'link' => '',
            ],
            [
                'title' => 'Flickr',
                'icon_path' => '',
                'is_active' => false,
                'order' => 5,
                'link' => '',
            ],
        ]);
    }
}
