<!doctype html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>WorkedOn Report Form</title>
</head>
<body>
    <h1>WorkedOn Reports</h1>
    <form action="{{ route('report.run') }}" method="post">
        @csrf

        <label for="status">Status</label>
        <select name="status" id="status">
            @foreach($statuses as $key => $value)
                <option value="{{ $value }}">{{ $value }}</option>
            @endforeach
        </select>

        <label for="tickets_from">From</label>
        <input type="date" id="tickets_from" name="tickets_from">

        <label for="tickets_to">To</label>
        <input type="date" id="tickets_to" name="tickets_to">

        <input type="submit" value="Report">
    </form>
</body>
</html>