<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('posts')->insert([
        [
          'user_id'=> 1,
          'category_id'=> 1,
          'title'=>'hoge',
          'content'=>'test',
          'created_at'=>'2020-09-17 16:27:51',
          'updated_at'=>'2020-09-17 16:27:51'
        ],
        [
          'user_id'=> 1,
          'category_id'=> 1,
          'title'=>'hoge',
          'content'=>'test1',
          'created_at'=>'2020-09-17 16:27:51',
          'updated_at'=>'2020-09-17 16:27:51'
        ],
        [
          'user_id'=> 1,
          'category_id'=> 1,
          'title'=>'hoge',
          'content'=>'test2',
          'created_at'=>'2020-09-17 16:27:51',
          'updated_at'=>'2020-09-17 16:27:51'
        ],
    ]);
    }
}
