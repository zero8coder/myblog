<?php

namespace App\Http\Controllers;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;


class ArticlesController extends Controller
{
    public function index(Category $category)
    {
        $articles = Article::orderby('id', 'desc')
                        ->whereHas('category', function ($query) {
                            $query->where('is_show', 1);
                        })
                        ->where('is_show', 1)
                        ->paginate(17);
        return view('articles.index', compact('articles', 'category'));
    }

    public function show($id)
    {
        $article = Article::with('category')->find($id);

        // 获取 “上一篇” 的 ID
        $previousArticleID = Article::whereHas('category', function ($query) {
                                                $query->where('is_show', 1);
                                              })
                                    ->where('id', '<', $id)
                                    ->where('is_show', 1)
                                    ->max('id');

        // 同理，获取 “下一篇” 的 ID
        $nextArticleId = Article::whereHas('category', function ($query) {
                                                $query->where('is_show', 1);
                                              })
                                    ->where('id', '<', $id)
                                    ->where('is_show', 1)
                                    ->min('id');

        return view('articles.show', compact('article', 'previousArticleID', 'nextArticleId'));
    }

    public function showWithCategory(Category $category, $id)
    {
        $article = Article::with('category')->find($id);

        // 获取 “上一篇” 的 ID
        $previousArticleID = Article::whereHas('category', function ($query) {
                                                $query->where('is_show', 1);
                                              })
                                        ->where('id', '<', $article->id)
                                        ->where('category_id', $category->id)
                                        ->where('is_show', 1)
                                        ->max('id');
        // 同理，获取 “下一篇” 的 ID
        $nextArticleId = Article::whereHas('category', function ($query) {
                                                $query->where('is_show', 1);
                                              })
                                        ->where('id', '>', $article->id)
                                        ->where('category_id', $category->id)
                                        ->where('is_show', 1)
                                        ->min('id');

        return view('articles.show', compact('article', 'previousArticleID', 'nextArticleId', 'category'));
    }
}
