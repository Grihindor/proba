<?php

namespace App\Http\Controllers;

use App\Comments;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\ValidationException;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['comments.show']]); // посредник auth будет применен только для метода show
    }
    public function save(Request $request, $id)
    {
        $valid = Validator::make($request->all(), [
            'g-recaptcha-response' => 'required|captcha'
        ]);
        $this->validate($request, [
            'author' => 'required|max:100|min:3',
            'email' => 'required|email',
            'content'=>'required|min:2|max:400'
        ]);
        if(!$valid->fails()) {
            $all = $request->all();
            $all['article_id'] = $id;
            Comments::create($all);
            return back()->with('message', 'Спасибо за комментарий. После проверки он будет опубликован');
        }
        else {
            return back()->with('message', 'ВЫ БОТ! УХОДИТЕ');
        }
    }
    public function show()
    {
        $comments=Comments::FullComments();
        return view('comments.show',['comments'=>$comments]);
    }
    public function delete($id)
    {
        $comment=Comments::find($id);
        $comment->delete();
        return back()->with(['message'=>"Комментарий ".$comment->title." удален"]);
    }
    public function published($id)
    {
        $comment=Comments::find($id);
        $comment->public=1;
        $comment->save();
        return back();
    }
    public function hidden($id)
    {
        $comment=Comments::find($id);
        $comment->public=0;
        $comment->save();
        return back();
    }
}