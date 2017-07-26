@extends('menu')
<head>
    <title>Восстановление пароля</title>
</head>

@section('content')
    <div class="content">
    <div>Reset Password</div>
    <div>
        @if (session('status'))
            <div>
                {{ session('status') }}
            </div>
        @endif
            <form method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}
                <div>
                    <label for="email">E-Mail Address</label>
                    <div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                        @if ($errors->has('email'))
                            <span>
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div>
                    <div>
                        <button type="submit">
                            Send Password Reset Link
                        </button>
                    </div>
                </div>
            </form>
    </div>
    </div>
@endsection
