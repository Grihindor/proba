@extends('menu')
<head>
    <title>Вход</title>
</head>
@section('content')
    <div class="content flex-center">
    <form method="POST" action={{action('Auth\LoginController@login')}}>
        <h2>Введите ваш логин и пароль</h2>
        Email: <br><input type="email" name="email"><br>
        Пароль:<br> <input type="password" name="password"><br>
        <a style="font-size: 13px"href="{{ route('password.email') }}">Забыли пароль?</a>
        <input type="hidden" name="_token" value="{{csrf_token()}}"><br>
        <input type="submit" value="Вход">
    </form>

        @if(Session::has('message'))
           <br/>{{Session::get('message')}}
        @endif
    </div>
@endsection