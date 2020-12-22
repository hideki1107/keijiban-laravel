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
        'name'=>'book',
        'email'=>'test@test.com',
        'password'=>bcrypt('testtest'),
    ]);
    }
}
