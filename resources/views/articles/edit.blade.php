@extends('menu')
<head>
    <title>Изменение статьи</title>
    <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
</head>

<body>
@section('content')
    <div class="header flex-center backgr">
        <h1>Изменение статьи</h1>
    </div>
    <div class="header flex-center ">
        <form class="create" method="POST" action="{{action('ArticlesController@update',['articles'=>$article->id])}}"
              enctype="multipart/form-data">
            <input type="hidden" name="_method" value="put">
            Превью:<br>
            @if(!empty($article->preview))
                <img src="{{$article->preview}}"><br/>
            @endif
            <input type="file" name="preview"><br>
            Название статьи:<br>
            <input type="text" name="title" value="{{$article->title}}"><br>
            Текст статьи:<br>
            <textarea name="content">{{$article->content}}</textarea><br>
            Категория:<br>
            <select name="category_id">
                @foreach($categories as $category)
                    @if($article->category_id==$category->id)
                        <option value="{{$category->id}}" selected>{{$category->title}}</option>
                    @else
                        <option value="{{$category->id}}">{{$category->title}}</option>
                    @endif
                @endforeach
            </select>
            <br>
            Разрешить комментарии?<br>
            <select name="comments_enable">
                <option value="1">Да</option>
                <option value="0">Нет</option>
            </select>
            <br>
            Опубликовать?<br>
            <select name="public">
                <option value="1">Да</option>
                <option value="0">Нет</option>
            </select>
            <br>
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="submit" value="Сохранить"><br/>
        </form>
    </div>
    <div class="flex-center">
        @if(Session::has('message'))
            {{Session::get('message')}}
        @endif
    </div>
@endsection
</body>