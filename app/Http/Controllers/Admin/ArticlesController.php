<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Auth;

class ArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $articles = Article::orderby('id', 'desc')->with('category')->paginate(17);
        return view('admin.articles.index', compact('articles'));
    }

    public function destroy(Article $article)
    {
        $article->delete();
        if(request()->wantsJson()){
            return response([],204);
        }
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
        $maxOrder = Article::max('order');
        $order = $maxOrder + 1;
        $article->order = $order;
        return view('admin.articles.create_and_edit', compact('categories', 'article'));
    }

    public function store(ArticleRequest $request, Article $article)
    {
        $this->validate($request, [
           'title' => 'required',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id'
        ]);
        $article->fill($request->all());
        $article->save();
        return redirect()->route('admin.articles.index')->with('success', '评论成功');
    }

    public function update(ArticleRequest $request, Article $article)
    {
        $article->update($request->all());
        return redirect()->route('admin.articles.index')->with('success', '修改成功');
    }

    public function uploadImage(Request $request)
    {
        // 初始化返回数据，默认是失败
        $data = [
            'success'   => false,
            'msg'       => '上传失败',
            'filename' => ''
        ];
        // 判断是否有上传文件，并赋值给 $file
        if ($file = $request->image) {
            // 保存图片到本地
            $folder_name = "articles/" . date('Ym/d', time());
            $disk = Storage::disk('oss');
            $result=$disk->put($folder_name, $request->image);
            // 图片保存成功的话
            if ($result) {
                $bucket = config("filesystems")["disks"]["oss"]["bucket"];
                $endPoint = config("filesystems")["disks"]["oss"]["endpoint"];
                $remotePath = 'https://'.$bucket.'.'.$endPoint.'/'.$result;

                $data['filename'] = $remotePath;
                $data['msg']       = "上传成功！";
                $data['success']   = true;
            }
        }

        return $data;
    }

    public function replies(Article $article, Request $request)
    {
        $replies_page = $request->get('page', 1);
        $replies_paginate = 17;
        $replies = $article->replies()->latest()->paginate($replies_paginate);
        return view('admin.replies.index', compact('article', 'replies'));
    }
}