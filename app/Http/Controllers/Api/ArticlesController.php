<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Transformers\ArticleTransformer;
use App\Http\Requests\Api\ArticleRequest;

class ArticlesController extends Controller
{
    public function store(ArticleRequest $request, Article $article)
    {
        $article->fill($request->all());
        $article->save();

        return $this->response->item($article, new ArticleTransformer())
            ->setStatusCode(201);
    }

    public function update(ArticleRequest $request, Article $article)
    {
        $article->update($request->all());
        return $this->response->item($article, new ArticleTransformer());
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return $this->response->noContent();
    }

    public function index(Request $request, Article $article)
    {
        $query = $article->query();

        if ($categoryId = $request->category_id) {
            $query->where('category_id', $categoryId);
        }

        $articles = $query->orderby('order', 'desc')
                ->whereHas('category', function ($query) {
                    $query->where('is_show', 1);
                })
                ->where('is_show', 1)
                ->paginate(20);
        return $this->response->paginator($articles, new ArticleTransformer());
    }

    public function show(Article $article)
    {
        return $this->response->item($article, new ArticleTransformer());
    }
}
