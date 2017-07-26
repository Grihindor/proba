@extends('menu')
<head>
    <title>Статья</title>
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body>
@section('content')
<div class="center content">
    <h1>{{$article->title}}</h1>
    <a>Категория:
        @foreach($category as $cat)
            <a href="/categories/show/{{$article->category_id}}">{{$cat->title}}</a><br/>
        @endforeach
    <a>Дата статьи: {{$article->updated_at}}</a><br/><br/>
    <img src="{{$article->preview}}">
    <br/>
    <div>
        {{$article->content}}
    </div><br/><br/>
        <h2>Комментарии:</h2>
        <ol style="display:block; padding:0" >
            @foreach($comments as $comment)
                <li ><a style="font-weight: bold">{{$comment->author}}: </a>
                    <a>{{$comment->content}}</a></li>
            @endforeach
        </ol>
    @if($article->comments_enable==1)
    <br/><br/>
        @include('comments.comments')
    @endif
</div>

</body>
@endsection