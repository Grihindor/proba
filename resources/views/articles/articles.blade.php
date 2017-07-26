@extends('menu')
<head>
    <title>Статьи</title>
    <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
</head>

<body>
@section('content')
    <div class="header flex-center">
    <h1>Статьи</h1>
    </div>
    <div class="content">
        <table>
        <tr style="font-size: 21px;">
            <th>Миниатюра</th>
            <th>Название</th>
            @can ('admin')
            <th>Статус</th>
            <th>Изменить</th>
            <th>Удалить</th>
            @endcan
        </tr>
        @foreach ($articles as $article)
            <tr>
                <td><img width=30 height=30 src="{{$article->preview}}"></td>
                <td style="max-width:300px" ><a href="{{action('FrontController@show',['id'=>$article->id])}}">{{$article->title}}</a></td>
                @can ('admin')
                    <td style="text-align: center">{{$article->public}}</td>
                    <td> <form method="GET" action="{{action('ArticlesController@edit',['articles'=>$article->id])}}">
                        <input type="hidden" name="_method" value="edit"/>
                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        <input type="submit" value="Изменить"/>
                    </form>
                </td>

                <td> <form class="buttondel" method="POST" action="{{action('ArticlesController@destroy',['articles'=>$article->id])}}">
                        <input type="hidden" name="_method" value="delete"/>
                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        <input type="submit" value="Удалить"/>
                    </form>
                </td>
                @endcan
            </tr>
        @endforeach
    </table>
    </div>
    <div class="flex-center">
        @if(Session::has('message'))
            <br/>{{Session::get('message')}}
        @endif
    </div>
@endsection
<script>
    $(document).ready(function() {
        $('.buttondel').submit(function(e){
            e.preventDefault();
            var m_method=$(this).attr('method');
            var m_action=$(this).attr('action');
            var m_data=$(this).serialize();
            $.ajax({
                type: m_method,
                url: m_action,
                data: m_data,
                success: function(data){
                    $('body').empty();
                    $('body').append(data);

                }

            });
        });
    });
</script>
</body>