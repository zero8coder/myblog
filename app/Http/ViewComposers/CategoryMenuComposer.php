<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Models\Category;

class CategoryMenuComposer
{
    public function compose(View $view)
    {
        $categoryMenus = Category::where('is_show', 1)->get();
        $view->with(compact('categoryMenus'));
    }
}