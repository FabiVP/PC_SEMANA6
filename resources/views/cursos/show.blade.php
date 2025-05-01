@extends('layouts.plantilla')

@section('title', 'Curso: ' . $curso->name)

@section('content')
    <h1>{{ $curso->name }}</h1>
    <p>{{ $curso->description }}</p>
    <a href="{{ route('cursos.index') }}">Volver</a>
@endsection