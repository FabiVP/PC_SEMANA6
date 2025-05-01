@extends('layouts.plantilla')

@section('title', 'Editar Curso')

@section('content')
    <h1>Editar Curso: {{ $curso->name }}</h1>
    <form action="{{ route('cursos.update', $curso->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Nombre:
            <input type="text" name="name" value="{{ $curso->name }}">
        </label>
        <label>Descripción:
            <textarea name="description">{{ $curso->description }}</textarea>
        </label>
        <button type="submit">Actualizar</button>
    </form>
@endsection