<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/categories',array('as'=>'home.page', function()
{
    $categories=\App\Category::all();
    return view('categories.categories',['categories'=>$categories]);
}));
Route::get('/categories/create', function()
{
    return view('categories.create');
});
Route::get('/articles', function()
{
    $articles=\App\Article::all();
    return view('articles.articles',['articles'=>$articles]);
});
Route::get('/articles/create', function()
{
    $categories=\App\Category::all();
    return view('articles.create',['categories'=>$categories]);
});

Route::get('comments',['as' => 'login', 'uses' => 'CommentsController@show']);
Route::get('comments/delete/{id}','CommentsController@delete');
Route::get('comments/published/{id}','CommentsController@published');
Route::get('comments/hidden/{id}','CommentsController@hidden');

Route::get('/', 'FrontController@index');

Route::get('/show/{id}',['as'=>'login','uses'=>'FrontController@show']);
Route::post('/show/{id}',['as' => 'login','uses' => 'CommentsController@save']);

Route::get('/categories/show/{id}',['as'=>'login','uses'=>'CategoriesController@show']);

Route::resource('Articles','ArticlesController');
Route::resource('Pages','PagesController');
Route::resource('Categories','CategoriesController');
Route::resource('Comments','CommentsController');

Route::get('auth/login', 'Auth\LoginController@showLoginForm');
Route::post('auth/login', 'Auth\LoginController@login');
Route::get('auth/logout', 'Auth\LoginController@logout');
Route::get('auth/register', 'Auth\RegisterController@showRegistrationForm');
Route::post('auth/register', 'Auth\RegisterController@register');

Route::get('password/email', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();
