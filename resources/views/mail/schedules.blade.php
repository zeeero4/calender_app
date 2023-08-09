<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .border-collapse {
            border-collapse: collapse;
        }

        th, td {
            text-align: center;
            border: solid 1px;
            padding: 5px
        }
    </style>
</head>

<body>

    <h1>{{ $user->name }}さんの明日の予定覧</h1>
    <table class="border-collapse ">
        <thead>
            <tr>
                <th scope="col">予定まで</th>
                <th scope="col">開始</th>
                <th scope="col">タイトル</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user->events as $event)
                <tr>
                    <td>{{ $event->start_diff() }}</td>
                    <td>{{ $event->start }}</td>
                    <td>{{ $event->title }}</td>
                    <td><a href="{{ route('events.show', $event) }}">詳細</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
