<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Lusy Wahyudi',
                'email' => 'lusy@wahyudi.com',
                'password' => bcrypt('newlusy2018!#@')
            ],
            [
                'name' => 'Bayu Respati',
                'email' => 'admin@admin.com',
                'password' => bcrypt('binus2015')
            ]
        ]);
    }
}
