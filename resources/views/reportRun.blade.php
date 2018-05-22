<!doctype html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>WorkedOn Report</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>External ID</th>
                <th>Title</th>
                <th>Status</th>
                <th>Created</th>
                <th>Updated</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->external_id }}</td>
                    <td>{{ $ticket->title }}</td>
                    <td>{{ $ticket->external_status }}</td>
                    <td>{{ $ticket->external_created }}</td>
                    <td>{{ $ticket->external_updated }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>