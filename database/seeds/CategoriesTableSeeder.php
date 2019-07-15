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
        $categories = [
            [
                'name'        => 'PHP',
                'description' => '我喜欢的语言',
                'slug'        => 'php',
                'is_show'     => 1,
                'order'       => 1,
            ],
            [
                'name'        => 'BUG',
                'description' => '遇到的问题',
                'slug'        => 'bug',
                'is_show'     => 1,
                'order'       => 2,
            ],
            [
                'name'        => 'Game',
                'description' => '人生游戏 游戏人生',
                'slug'        => 'game',
                'is_show'     => 1,
                'order'       => 3,
            ],
        ];

        \App\Models\Category::insert($categories);
    }
}
