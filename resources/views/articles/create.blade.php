@extends('menu')
<head>
    <title>Добавление статьи</title>
    <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
</head>

<body>
@section('content')
    <div class="header flex-center">
    <h1>Добавление статьи</h1>
    </div>
    <div class="flex-center" style="text-align: left">
        <form class="create" method="POST" action="{{action('ArticlesController@store')}}"
              enctype="multipart/form-data">
            Превью: <br/>
            <input type="file" name="preview" /><br/>
            Название статьи:<br/>
            <input type="text" name="title"/><br/>
            Текст статьи:<br>
            <textarea name="content" spellcheck="false"></textarea><br>
            Категория:<br/>
            <select name="category_id">
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->title}}</option>
                @endforeach
            </select><br/>
            Разрешить комментарии?<br/>
            <select name="comments_enable">
                <option value="1">Да</option>
                <option value="0">Нет</option>
            </select><br/>
            Опубликовать?<br>
            <select name="public">
                <option value="1">Да</option>
                <option value="0">Нет</option>
            </select><br>
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