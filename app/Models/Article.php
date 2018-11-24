<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable =['title', 'body', 'category_id', 'view_count', 'order', 'is_show'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
