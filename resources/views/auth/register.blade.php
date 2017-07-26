@extends('menu')
<head>
    <title>Регистрация</title>
</head>

<body>
@section('content')
    <div class="content">
        <div>Регистрация</div>
        <form method="POST" action="{{ url('register') }}">
            {{ csrf_field() }}
            <div>
                <label for="name" >Имя</label><br/>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>

            </div>
            <div>
                <label for="email">E-Mail</label>
                <div>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                </div>
            </div>
            <div>
                <label for="password" >Пароль</label>
                <div>
                    <input id="password" type="password" name="password" required>
                </div>
            </div>
            <div>
                <label for="password-confirm">Повторите пароль</label>
                <div>
                    <input id="password-confirm" type="password" name="password_confirmation" required>
                </div>
            </div>
            <div>
                <div>
                    <button type="submit">Зарегистрироваться</button><br/>
                    @if ($errors->has('name'))
                        <span>
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                    @endif
                    @if ($errors->has('email'))
                        <span>
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                    @if ($errors->has('password'))
                        <br/>
                        <span>
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </form>
    </div>
@endsection
</body>