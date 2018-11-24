<?php

namespace App\Http\Controllers;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(Category $category) {
        $articles = Article::whereHas('category', function ($query) {
                                                $query->where('is_show', 1);
                                              })
                            ->where('category_id', $category->id)
                            ->where('is_show', 1)
                            ->orderby('order', 'desc')
                            ->paginate(17);
        return view('articles.index', compact('articles', 'category'));
    }
}
