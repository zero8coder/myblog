<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Models\Category;

class CategoryMenuComposer
{
    public function compose(View $view)
    {
        // 缓存分类
        // $categoryMenus = \Cache::rememberForever('categoryMenus', function () {
        //     return Category::where('is_show', 1)->orderby('order', 'asc')->get();
        // });
        $categoryMenus = Category::where('is_show', 1)->orderby('order', 'asc')->get();
        $view->with(compact('categoryMenus'));
    }
}