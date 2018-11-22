<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Category;

class ArticlesController extends Controller
{
    public function index()
    {
        $articles = Article::orderby('id', 'desc')->with('category')->paginate(17);
        return view('admin.articles.index', compact('articles'));
    }

    public function destroy(Article $article)
    {
        $article->delete();
        session()->flash('success', '删除成功');
        return back();
    }

    public function edit(Article $article)
    {
        $categories = Category::all();
        return view('admin.articles.create_and_edit', compact('categories', 'article'));
    }

    public function create(Article $article)
    {
        $categories = Category::all();
        return view('admin.articles.create_and_edit', compact('categories', 'article'));
    }

    public function store(ArticleRequest $request, Article $article)
    {
        $article->fill($request->all());
        $article->save();
        return redirect()->route('admin.articles.index')->with('success', '添加成功');
    }

    public function update(ArticleRequest $request, Article $article)
    {
        $article->update($request->all());
        return redirect()->route('admin.articles.index')->with('success', '修改成功');
    }
}
