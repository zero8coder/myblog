<?php

namespace App\Http\Controllers;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Filters\ArticlesFilters;


class ArticlesController extends Controller
{
    public function index(Category $category, ArticlesFilters $filters)
    {
        $articles = Article::filter($filters)->onShowArticle()->latest()->paginate(17);

        return view('articles.index', compact('articles', 'category'));
    }

    public function show(Article $article, Request $request)
    {
        $replies_page = $request->get('page', 1);
        $replies_paginate = 1;
        // 楼层数
        $replies_num = ($replies_page-1) * 1;

        if ($article->is_show == 0 || $article->category->is_show == 0) {
            return;
        }
        // 获取 “上一篇” 的 ID
        $previousArticleID = Article::onShowArticle()->where('order', '<', $article->order)->max('id');

        // 同理，获取 “下一篇” 的 ID
        $nextArticleId = Article::onShowArticle()->where('order', '>', $article->order)->min('id');

        $replies = $article->replies()->paginate($replies_paginate);


        return view('articles.show', compact('article', 'previousArticleID', 'nextArticleId', 'replies', 'replies_num'));
    }

    public function showWithCategory(Category $category, Article $article, Request $request)
    {
        $replies_page = $request->get('page', 1);
        $replies_paginate = 10;
        // 楼层数
        $replies_num = ($replies_page-1) * 1;

        if ($article->category_id != $category->id || $article->is_show == 0 || $article->category->is_show == 0) {
            return;
        }
        // 获取 “上一篇” 的 ID
        $previousArticleID = Article::onShowArticle()->where('order', '<', $article->order)->where('category_id', $category->id)->max('id');
        // 同理，获取 “下一篇” 的 ID
        $nextArticleId = Article::onShowArticle()->where('order', '>', $article->order)->where('category_id', $category->id)->min('id');

        $replies = $article->replies()->paginate($replies_paginate);

        return view('articles.show', compact('article', 'previousArticleID', 'nextArticleId', 'category', 'replies', 'replies_num'));
    }
}