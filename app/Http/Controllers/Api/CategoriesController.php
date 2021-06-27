<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Transformers\CategoryTransformer;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::orderby('order', 'asc')->where('is_show', 1)->get();
        return $this->response->collection($categories, new CategoryTransformer());
    }
}
