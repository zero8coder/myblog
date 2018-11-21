<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;

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

        echo "修改";
    }

    public function create()
    {
        echo "添加";
    }
}
