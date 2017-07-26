<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Cormorant" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=PT+Serif" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
</head>

<body>
<div style="position: absolute; z-index: 100">
@if(isset(Auth::user()->name))
    <div class="side">
        <ul class="menu1">
            <a href="/">Главная</a>
            <li class="menu__list"><a href="/articles">Статьи</a>
                <ul class="menu__drop">
                    <li><a href="/articles/create">Добавить статью</a></li>
                </ul>
            </li>
            <a href="/categories">Категории</a>
            <li class="menu__list"><a>ВЫ: {{ Auth::user()->name }}</a>
                <ul class="menu__drop">
                    <li><a href="/auth/logout">Выход</a></li>
                </ul>
            </li>
            @can('admin')
                <li class="menu__list"><a>Управление</a>
                    <ul class="menu__drop" >
                        <li><a href="/categories/create">Добавить категорию</a></li>
                        <li><a href="/comments">Управление комментариями</a></li>
                    </ul>
                </li>
            @endcan
        </ul>
    </div>
@else
    <div class="side">
        <ul class="menu1">
            <a href="/">Главная</a>
            <a href="/articles">Статьи</a>
            <a href="/categories">Категории</a>
            <li class="menu__list"><a>Вход</a>
                <ul class="menu__drop" >
                    <li><a href="/auth/login">Войти</a></li>
                    <li><a href="/auth/register">Зарегистрироваться</a></li>
                </ul>
            </li>
        </ul>
    </div>
@endif
</div>
<div>@yield('content')</div>
</body>
</html>