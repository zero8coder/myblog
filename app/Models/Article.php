<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable =['title', 'body', 'category_id', 'view_count', 'order'];
}
