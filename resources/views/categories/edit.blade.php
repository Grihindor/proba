@extends('menu')
<head>
    <title>Изменение категории</title>
    <link href="https://fonts.googleapis.com/css?family=Press+Start+2P" type="text/css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
</head>

<body>
@section('content')
    <div class="header flex-center backgr">
    <h1>Изменение категории</h1>
    </div>
    <div class="content tbl">
    <form class="create" method="POST" action="{{action('CategoriesController@update',['categories'=>$category->id])}}">
    Название категории<br>
    <input type="text" name="title" value="{{$category->title}}"/><br>
    <input type="hidden" name="_method" value="put"/>
    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
    <input type="submit" value="Сохранить"><br/>
        @if(Session::has('message'))
            {{Session::get('message')}}
        @endif
    </form>
    </div>
@endsection

<script>
    $(document).ready(function() {
        $('.create').submit(function(e){
            e.preventDefault();
            var m_method=$(this).attr('method');
            var m_action=$(this).attr('action');
            var m_data=$(this).serialize();
            $.ajax({
                type: m_method,
                url: m_action,
                data: m_data,
                success: function(data){
                    $('input[type=text]').val('');
                    $('body').empty();
                    $('body').append(data);
                }

            });
        });
    });
</script>
</body>