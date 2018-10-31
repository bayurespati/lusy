<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'title' => 'Ikebana Ikenobo',
                'type' => '1',
            ],
            [
                'title' => 'Handicraft Goods',
                'type' => '1',
            ],
            [
                'title' => 'Classes',
                'type' => '2',
            ],
            [
                'title' => 'Workshop',
                'type' => '2',
            ],
            [
                'title' => 'Exhibition',
                'type' => '2',
            ],
            [
                'title' => 'Ikebana Ikenobo',
                'type' => '3',
            ],
            [
                'title' => 'Handicraft Goods',
                'type' => '3',
            ],
            [
                'title' => 'Books',
                'type' => '3',
            ],
        ]);
    }
}
