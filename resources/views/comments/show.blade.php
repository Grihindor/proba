@extends('menu')
<head>
    <title>Все комментарии</title>
</head>


<body>
@section('content')
    <div class="content ">
    <table>
        <tr  style="font-size: 20px;">
            <th>Статья</th>
            <th>Автор</th>
            <th>Email</th>
            <th>Комментарий</th>
            <th>Дата</th>
            <th>Статус</th>
            <th>Действие</th>
        </tr>
        <tr></tr>
        <tr></tr>
        @foreach($comments as $comment)
            <tr>
                <td>{{$comment->article}}</td>
                <td>{{$comment->author}}</td>
                <td>{{$comment->email}}</td>
                <td>{{$comment->content}}</td>
                <td>{{$comment->created_at}}</td>
                <td style="text-align: center">{{$comment->public}}</td>
                <td>
                    <form method="GET" action="{{action('CommentsController@delete',['id'=>$comment->id])}}">
                        <input type="hidden" name="_method" value="delete"/>
                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        <input type="submit" value="Удалить"/>
                    </form>
                    <form method="GET" action="{{action('CommentsController@published',['id'=>$comment->id])}}">
                        <input type="hidden" name="_method" value="published"/>
                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        <input type="submit" value="Опубликовать"/>
                    </form>
                    <div>
                    <form method="GET" action="{{action('CommentsController@hidden',['id'=>$comment->id])}}">
                        <input type="hidden" name="_method" value="hidden"/>
                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        <input type="submit" value="Скрыть"/>
                    </form></div>
                </td>
            </tr>
        @endforeach
    </table>
</div>

<script>
    $(document).ready(function() {
        $('form').submit(function(e){
            e.preventDefault();
            var m_method=$(this).attr('method');
            var m_action=$(this).attr('action');
            var m_data=$('body').serialize();
            $.ajax({
                type: m_method,
                url: m_action,
                data: m_data,
                success: function(data){
                    $('body').empty();
                    $('body').append(data)
                }
            });
        });
    });

</script>

@endsection
</body>