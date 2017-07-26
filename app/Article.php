<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Category;

class Article extends Model
{
    protected $table="articles";
    protected $fillable=['title','content','preview','category_id','comments_enable','public'];

    public function comments()
    {
        return $this->hasMany('App\Comments','article_id','id');
    }
    public function category()
    {
        return $this->belongsTo('App\Category','category_id','id');
    }
    public function commentsCount()
    {
        return $this->hasOne('App\Comments')->where('comments.public','=','1')
            ->selectRaw('article_id, count(*) as aggregate')
            ->groupBy('article_id');
    }
    public function getCommentsCountAttribute()
    {
        if ( ! array_key_exists('commentsCount', $this->relations))
            $this->load('commentsCount');
        $related = $this->getRelation('commentsCount');
        return ($related) ? (int) $related->aggregate : 0;
    }


}
