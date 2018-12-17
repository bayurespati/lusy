<?php

use Illuminate\Database\Seeder;

class SubCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sub_categories')->insert([
            [
                'title' => 'Ikenobo Jiyuka',
                'category_id' => '1',
            ],
            [
                'title' => 'Ikenobo Rikka',
                'category_id' => '1',
            ],
            [
                'title' => 'Ikenobo Shoka',
                'category_id' => '1',
            ],
            [
                'title' => 'Bows',
                'category_id' => '2',
            ],
            [
                'title' => 'Ribbon Flower',
                'category_id' => '2',
            ],
            [
                'title' => 'Sock Toys',
                'category_id' => '2',
            ],


            [
                'title' => 'Ikenobo Jiyuka',
                'category_id' => '6',
            ],
            [
                'title' => 'Ikenobo Rikka',
                'category_id' => '6',
            ],
            [
                'title' => 'Ikenobo Shoka',
                'category_id' => '6',
            ],
            [
                'title' => 'Bows',
                'category_id' => '7',
            ],
            [
                'title' => 'Ribbon Flower',
                'category_id' => '7',
            ],
            [
                'title' => 'Sock Toys',
                'category_id' => '7',
            ],
        ]);
    }
}
