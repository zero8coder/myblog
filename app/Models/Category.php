<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'description', 'is_show', 'order', 'slug'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

}
