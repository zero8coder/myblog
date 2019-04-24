<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Auth;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create(Category $category)
    {
        $maxOrder = Category::max('order');
        $order = $maxOrder + 1;
        $category->order = $order;
        return view('admin.categories.create_and_edit', compact('category'));
    }

    public function store(Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $category->fill($request->all());
        $category->save();

        return redirect()->route('admin.categories.index')->with('success', '添加成功');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.create_and_edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {

        $this->validate($request, [
            'name' => 'required'
        ]);

        $category->update($request->all());
        return redirect()->route('admin.categories.index')->with('success', '修改成功');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('success', '删除成功');
        return back();
    }
}