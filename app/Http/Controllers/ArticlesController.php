<?php

namespace App\Http\Controllers;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;


class ArticlesController extends Controller
{
    public function index(Category $category)
    {
        $articles = Article::orderby('id', 'desc')->paginate(17);
        return view('articles.index', compact('articles', 'category'));
    }

    public function show(Article $article)
    {
        // 获取 “上一篇” 的 ID
        $previousArticleID = Article::where('id', '<', $article->id)->max('id');
        // 同理，获取 “下一篇” 的 ID
        $nextArticleId = Article::where('id', '>', $article->id)->min('id');
        return view('articles.show', compact('article', 'previousArticleID', 'nextArticleId'));
    }

    public function showWithCategory(Category $category, Article $article)
    {
        // 获取 “上一篇” 的 ID
        $previousArticleID = Article::where('id', '<', $article->id)->where('category_id', $category->id)->max('id');
        // 同理，获取 “下一篇” 的 ID
        $nextArticleId = Article::where('id', '>', $article->id)->where('category_id', $category->id)->min('id');

        return view('articles.show', compact('article', 'previousArticleID', 'nextArticleId', 'category'));
    }
}
