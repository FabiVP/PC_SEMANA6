@extends('layouts.plantilla')

@section('title', 'Crear Curso')

@section('content')
    <form action="{{ route('cursos.store') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Nombre del curso">
        <textarea name="description"></textarea>
        <button type="submit">Guardar</button>
    </form>
@endsection