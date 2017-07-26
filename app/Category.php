<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";
    protected $fillable = ['title'];

    public function articles()
    {
        return $this->hasMany('App\Article', 'category_id', 'id');
    }
}

