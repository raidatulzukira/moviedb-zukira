<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    protected $fillable = ['category_name', 'description'];
    use SoftDeletes;

    //punya bapak
    // return $this->belongsTo(Movie::class);
}
