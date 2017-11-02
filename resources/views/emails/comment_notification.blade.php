<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <h1>New Comment</h1>
        <p>
            Task: {{ $task->name }}
        </p>
        <p>
            Comment: {!! $task->comments->first()->body !!}
        </p>
    </body>
</html>
