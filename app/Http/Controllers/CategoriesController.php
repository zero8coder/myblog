<?php

namespace App\Http\Controllers;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(Category $category) {
        $articles = Article::latest("order")->categoryShow()->show()->where('category_id', $category->id)->paginate(17);
        return view('articles.index', compact('articles', 'category'));
    }
}
