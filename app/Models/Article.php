<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use RecordsActivity;

    protected $fillable =['title', 'body', 'category_id', 'view_count', 'order', 'is_show'];

    protected  static function boot()
    {
        parent::boot();

        static::addGlobalScope('replyCount', function ($builder){
           $builder->withCount('replies');
        });

        static::deleting(function ($article) {
           $article->replies()->delete();
        });

    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function path()
    {
        return "/articles/{$this->category->slug}/{$this->id}";
    }

    public function pathWithoutCategory()
    {
        return "/articles/{$this->id}";
    }

    public function addReply($reply)
    {
        $this->replies()->create($reply);
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    public function scopeShow($query)
    {
        return $query->where('is_show', 1);
    }

    public function scopeCategoryShow($query)
    {
        return $query->whereHas('category', function ($categoryQuery) {
            return $categoryQuery->where('is_show', 1);
        });
    }

    public function scopeOnShowArticle()
    {
        return $this->show()->categoryShow();
    }


}
