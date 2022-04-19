<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body class="antialiased">
<form action="{{route('upload')}}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file">
    <button>Store</button>
</form>

<ul>
    @foreach(\App\Models\File::all() as $file)
        <li><a href="{{route('get-file', [$file])}}">{{$file->name}}</a></li>
    @endforeach
</ul>
</body>
</html>
