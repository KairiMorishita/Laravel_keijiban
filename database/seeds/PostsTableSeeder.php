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
        // テーブルのクリア
        DB::table('posts')->truncate();

        // 初期データ用意（列名をキーとする連想配列）
        $posts = [];

        // 登録
        foreach($posts as $post) {
            Post::create($post);
    }
}
