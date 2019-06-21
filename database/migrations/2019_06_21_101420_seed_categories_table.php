<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
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

        DB::table('categories')->insert($categories);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('categories')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
