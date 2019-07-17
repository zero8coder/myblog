<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Models\Category;

class CategoryMenuComposer
{
    public function compose(View $view)
    {
        $categoryMenus = \Cache::rememberForever('categoryMenus', function () {
            return Category::where('is_show', 1)->orderby('order', 'asc')->get();
        });
        $view->with(compact('categoryMenus'));
    }
}