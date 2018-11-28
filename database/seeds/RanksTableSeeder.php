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
                'title' => 'Nyumon',
                'price' => '35',
            ],
            [
                'tile' => 'Shoden',
                'price' => '35',
            ],
            [
                'tile' => 'Chuden',
                'price' => '35',
            ],
            [
                'tile' => 'Kaiden',
                'price' => '50',
            ],
            [
                'tile' => 'Kasho',
                'price' => '60',
            ],
            [
                'tile' => 'Junkakyo',
                'price' => '65',
            ],
            [
            	'tile' => 'Junkakan',
                'price' => '65',
            ],
            [
                'tile' => 'Junkako',
                'price' => '65',
            ],
            [
                'tile' => 'Kakyo',
                'price' => '130',
            ],
            [
                'tile' => 'Kakan',
                'price' => '130',
            ],
            [
                'tile' => 'Kako',
                'price' => '130',
            ],
            [
                'tile' => 'Sokakyo',
                'price' => '195',
            ],
            [
                'tile' => 'Sokakan',
                'price' => '195',
            ],
            [
                'tile' => 'Sokako',
                'price' => '195',
            ],
            [
                'tile' => 'Junkatoku',
                'price' => '325',
            ],
            [
                'tile' => 'Katoku',
                'price' => '520',
            ],
            [
                'tile' => 'Fukusokatoku',
                'price' => '650',
            ],
            [
                'title' => 'Sokatoku',
                'price' => '840'
            ]
        ]);
    }
}
