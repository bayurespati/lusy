<?php

use Illuminate\Database\Seeder;

class RanksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ranks')->insert([
            [
                'title' => 'Tingkat 1',
                'price' => '1000000',
            ],
            [
                'tile' => 'Tingkat 2',
                'price' => '1000000',
            ],
            [
                'tile' => 'Tingkat 3',
                'price' => '1000000',
            ],
            [
                'tile' => 'Tingkat 4',
                'price' => '1000000',
            ],
            [
                'tile' => 'Tingkat 5',
                'price' => '1000000',
            ],
            [
                'tile' => 'Tingkat 6',
                'price' => '1000000',
            ],
            [
            	'tile' => 'Tingkat 7',
                'price' => '1000000',
            ],
            [
                'tile' => 'Tingkat 8',
                'price' => '1000000',
            ],
            [
                'tile' => 'Tingkat 9',
                'price' => '1000000',
            ],
            [
                'tile' => 'Tingkat 10',
                'price' => '1000000',
            ],
            [
                'tile' => 'Tingkat 11',
                'price' => '1000000',
            ],
            [
                'tile' => 'Tingkat 12',
                'price' => '1000000',
            ],
            [
                'tile' => 'Tingkat 13',
                'price' => '1000000',
            ],
            [
                'tile' => 'Tingkat 14',
                'price' => '1000000',
            ],
            [
                'tile' => 'Tingkat 15',
                'price' => '1000000',
            ],
            [
                'tile' => 'Tingkat 16',
                'price' => '1000000',
            ],
            [
                'tile' => 'Tingkat 17',
                'price' => '1000000',
            ]
        ]);
    }
}
