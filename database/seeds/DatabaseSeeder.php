<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            'film_id' => 5,
            'user_id' => 1,
            'name' => 'test user 1',
            'comment' => 'This is test comment 1',
        ]);
		DB::table('comments')->insert([
            'film_id' => 6,
            'user_id' => 1,
            'name' => 'test user 2',
            'comment' => 'This is test comment 2',
        ]);
		DB::table('comments')->insert([
            'film_id' => 7,
            'user_id' => 1,
            'name' => 'test user 2',
            'comment' => 'This is test comment 3',
        ]);
    }
}