<?php

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Category;

class ArticlesTableSeeder extends Seeder
{
    public function run()
    {
        // 所有分类 ID 数组
        $category_ids = Category::all()->pluck('id')->toArray();

        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);

        $articles = factory(Article::class)
                        ->times(100)
                        ->make()
                        ->each(function ($article, $index)
                             use ($category_ids, $faker)
        {
            // 从分类 ID 数组中随机取出一个并赋值
            $article->category_id = $faker->randomElement($category_ids);
        });

        Article::insert($articles->toArray());
    }
}
