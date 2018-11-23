<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Models\Category;

class CategoryMenuComposer
{
    public function compose(View $view)
    {
        $categoryMenus = Category::all();
        $view->with(compact('categoryMenus'));
    }
}