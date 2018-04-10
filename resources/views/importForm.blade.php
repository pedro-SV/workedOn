<!DOCTYPE html>
<html>
    <head>
        <title>WorkedOn Import</title>
    </head>

    <body>
        <h1>Tickets Import</h1>

        <form action="{{ route('import.run') }}" method="post">
            @csrf

            <label for="project">Project</label>
            <select name="project" id="project">
                @foreach($projects as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>

            <label for="status">Status</label>
            <select name="status" id="status">
                @foreach($status as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>

            <input type="submit" value="Import">

        </form>
    </body>
</html>