<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Dreams </title>
    <style>
        *{
            margin: 0;
        }
        body{
            background: gold;
        }
    </style>
</head>
<body>


   @forelse ( $dreams as $dream)
    <h1>{{ $dream->content }}</h1>
    <pre>by {{ $dream->name }}</pre>
    <small>{{ $dream->created_at->diffForhumans() }}</small>
   @empty
    No dreams posted yet
   @endforelse


</body>
</html>
