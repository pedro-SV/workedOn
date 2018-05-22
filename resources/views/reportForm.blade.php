<!doctype html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>WorkedOn Report</title>
</head>
<body>
    <ul>
        @foreach($statuses as $status)
            <li>{{ $status }}</li>
        @endforeach
    </ul>
</body>
</html>