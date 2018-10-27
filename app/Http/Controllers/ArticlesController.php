<?php

namespace App\Http\Controllers;
use App\Models\Article;
use Illuminate\Http\Request;


class ArticlesController extends Controller
{
    public function index()
    {
        $articles = Article::paginate(17);
        return view('articles.index', compact('articles'));
    }
}
