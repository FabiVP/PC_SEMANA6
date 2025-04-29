<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Estado</title>
</head>
<body>
    <h1>Crear un nuevo Estado</h1>

    <form method="POST" action="{{ route('statuses.store') }}">
        @csrf
        <textarea name="body" placeholder="Escribe tu estado aquí..." required></textarea>
        <button type="submit" id="create_status">Crear Estado</button>
    </form>
</body>
</html>
