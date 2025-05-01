@extends('layouts.plantilla')
@section('title', 'Lista de Cursos')
@section('content')
    <h1>Bienvenido a la lista de cursos</h1>
    <h1>Cursos Disponibles</h1>
    <a href="{{ route('cursos.create') }}">Crear Nuevo Curso</a>
    <ul>
        @foreach ($cursos as $curso)
            <li>
                <a href="{{ route('cursos.show', $curso->id) }}">{{ $curso->name }}</a>
                <a href="{{ route('cursos.edit', $curso->id) }}">Editar</a>
                <form action="{{ route('cursos.destroy', $curso->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Eliminar</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection