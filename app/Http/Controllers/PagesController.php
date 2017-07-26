<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function store(Request $request)
    {
        Category::create($request->all());
        return back();
    }
}
