<?php

namespace App\Http\Controllers;
use App\Article;
use App\Comments;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FrontController extends Controller
{
    public function index()
    {
        $articles=Article::where('public','=',1)->get();
        $comment=Comments::all();
        return view('index',['articles'=>$articles],['comment'=>$comment]);
    }
    public function show($id)
    {
        $category=Article::where('public','=',1)->find($id)->category()->get();
        $comments=Article::where('public','=',1)->find($id)->comments()->where('public','=','1')->get();
        $article=Article::where('public','=',1)->find($id);
        return view('show',['article'=>$article,'comments'=>$comments,'category'=>$category]);
    }
}
