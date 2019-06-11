<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable =['nickname', 'email', 'content'];
}
