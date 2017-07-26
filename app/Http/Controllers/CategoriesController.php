<?php

namespace App\Http\Controllers;

use App\Category;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\ValidationException;

use Illuminate\Session\Store;
use App\Http\Requests;

class CategoriesController extends Controller
{

    public function create()
    {
        return view('categories.create');
    }
    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'title' => 'unique:categories|required|min:2|max:50',
        ]);
        if ($v->fails())
        {
            return redirect()->back()->with('message','Категория уже существует');
        }
        Category::create($request->all());
        return back()->with('message', 'Категория добавлена');
    }
    public function destroy($id)
    {
        $category=Category::find($id);
        $category->delete();
        return back()->with(['message'=>"Категория ".$category->title." удалена"]);
    }
    public function edit($id)
    {
        $category=Category::find($id);
        return view('categories.edit',['category'=>$category]);
    }
    public function update(Request $request,$id)
    {
        $category=Category::find($id);
        $category->update($request->all());
        $category->save();
        return back()->with('message','Категория обновлена');
    }
    public function show($id)
    {
        $articles=Category::find($id)->articles()->where('public','=','1')->get();
        $category=Category::find($id);
        return view('categories.show',['articles'=>$articles,'category'=>$category]);
    }

}

