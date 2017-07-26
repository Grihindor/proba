@extends('menu')
<head>
    <title>Категории</title>
    <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
</head>

<body>
@section('content')

    <div class="header flex-center ">
        <h1>Категории</h1>
    </div>
    <div class="content">
    <table>
        <tr style="font-size: 21px;">
            <th>Название</th>
            @can('admin')
            <th>Изменить</th>
            <th>Удалить</th>
                @endcan
        </tr>
        @foreach ($categories as $category)
            <tr>
                <td><a href="{{action('CategoriesController@show',['id'=>$category->id])}}">{{$category->title}}</a></td>
                @can ('admin')
                <td> <form method="GET" action="{{action('CategoriesController@edit',['categories'=>$category->id])}}">
                        <input type="hidden" name="_method" value="edit"/>
                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        <input type="submit" value="Изменить"/>
                    </form>
                </td>
                <td>
                    <form class="buttondel" method="POST" action="{{action('CategoriesController@destroy',['categories'=>$category->id])}}">
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

