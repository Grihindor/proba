<!doctype html>

<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Press+Start+2P" type="text/css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cormorant" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body>
    <h2>Ваш комментарий:</h2>
    <form class="create" method="POST" action="{{action('CommentsController@save',['article'=>$article->id])}}">

        @if(isset(Auth::user()->name))
            <input type="hidden" name="author" value="{{Auth::user()->name}}"/>
            От:<a div style="font-weight: bold;"> {{ Auth::user()->name }}</a><br/>
            <input type="hidden" name="email" value="{{Auth::user()->email}}"/>
            email:<a div style="font-weight: bold;"> {{ Auth::user()->email }}</a><br/>
        @else
            Ваше имя:<br/>
            <input type="text" name="author"/><br>
            Ваш email:<br/>
            <input type="text" name="email"/><br>
        @endif
        Ваше сообщение:<br>
        <textarea name="content" spellcheck="false"></textarea><br/>
        <input type="hidden" name="_token" value="{{csrf_token()}}"/></br>
        <div class="flex-center">
            {!! app('captcha')->display(['data-size' => 'normal']) !!}
        </div>

        <input type="submit" value="Отправить"/><br/>
    </form>
    @if(Session::has('message'))
        {{Session::get('message')}}
    @endif

    <script>
        $(document).ready(function() {
            $('.create').submit(function (e) {
                e.preventDefault();
                var m_method = $(this).attr('method');
                var m_action = $(this).attr('action');
                var m_data = $(this).serialize();
                $.ajax({
                    type: m_method,
                    url: m_action,
                    data: m_data,
                    success: function (data) {
                        $('body').empty();
                        $('body').append(data);
                    }
                });
            });
        });
    </script>
</body>
</html>