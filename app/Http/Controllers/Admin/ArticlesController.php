<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use App\Handlers\ImageUploadHandler;
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
        $article->fill($request->all());
        $article->save();
        return redirect()->route('admin.articles.index')->with('success', '添加成功');
    }

    public function update(ArticleRequest $request, Article $article)
    {
        $article->update($request->all());
        return redirect()->route('admin.articles.index')->with('success', '修改成功');
    }

    public function uploadImage(Request $request, ImageUploadHandler $uploader)
    {
        // 初始化返回数据，默认是失败
        $data = [
            'success'   => false,
            'msg'       => '上传失败',
            'file_path' => ''
        ];
        // 判断是否有上传文件，并赋值给 $file
        if ($file = $request->upload_file) {
            // 保存图片到本地
            $result = $uploader->save($request->upload_file, 'articles', 1, 1024);
            // 图片保存成功的话
            if ($result) {
                $data['file_path'] = $result['path'];
                $data['msg']       = "上传成功！";
                $data['success']   = true;
            }
        }

        return $data;
    }
}
