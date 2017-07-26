@extends('menu')
<head>
    <title>Добавление категории</title>
    <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
</head>


<body>
@section('content')
    <div class="header flex-center">
    <h1>Добавление категории</h1><br/>
    </div>
    <div class="content tbl">
        <form class="create" method="POST" action="{{action('CategoriesController@store')}}">
            Название категории: <br/>
            <input type="text" name="title"><br/>
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="submit" value="Сохранить"><br/>
        </form>
    </div>
    <div class="flex-center">
        @if(Session::has('message'))
            <br/>{{Session::get('message')}}
        @endif
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