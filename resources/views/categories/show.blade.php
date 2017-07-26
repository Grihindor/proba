@extends('menu')
<head>
    <title>Категория</title>
</head>

<body>
@section('content')
    <div class="center content">
        <h1>Категория: {{$category->title}}</h1><br/>
        <h2>Список статей</h2>
        <ol style="display:block; padding:0" >
            <div class="content index">
                <?php
                $num=0;
                ?>
                @foreach($articles as $article)
                    @if($num%2==0)
                        <div class="artborder">
                            <a style="font-size: 13px" >{{$article->updated_at}}</a>
                            <?php $num=$num+1; ?>
                            <a href="{{action('FrontController@show',['id'=>$article->id])}}"><h2>{{$article->title}}</h2></a>
                            <div>
                                @if(!empty($article->preview))
                                    <img style="max-width: 100px;max-height: 100px" src="{{$article->preview}}"><br/>
                                @endif
                                <a>{{str_limit($article->content, 150)}}</a><br/>

                                <a>Комментариев:{{$article->commentsCount}}</a><br/>
                            </div></div><br/>
                    @else <div class="artborder">
                        <a style="font-size: 13px" >{{$article->updated_at}}</a>
                        <?php $num=$num+1; ?>
                        <a href="{{action('FrontController@show',['id'=>$article->id])}}"><h2>{{$article->title}}</h2></a>
                        <div>
                            @if(!empty($article->preview))
                                <img style="max-width: 100px;max-height: 100px" src="{{$article->preview}}"><br/>
                            @endif
                            <a>{{str_limit($article->content, 150)}}</a><br/>

                            <a>Комментариев:{{$article->commentsCount}}</a><br/>
                        </div>
                    </div>
                    <br/>
                    @endif
                @endforeach
            </div>
        </ol>
    </div>
</body>
@endsection