<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use RecordsActivity;
    protected $fillable =['nickname', 'email', 'content'];
}