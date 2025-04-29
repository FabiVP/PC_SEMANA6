<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estados</title>
</head>
<body>
    <h1>Lista de Estados</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @foreach ($statuses as $status)
        <p>{{ $status->user->name }} dijo: "{{ $status->body }}"</p>
    @endforeach
</body>
</html>
