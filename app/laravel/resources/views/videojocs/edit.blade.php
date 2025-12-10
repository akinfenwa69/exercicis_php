@extends('layout')

@section('title', 'Editar videojoc')

@section('content')
    <h1>Editar videojoc</h1>
    <form method="POST" action="{{ route('videojocs.update', $videojoc) }}">
        @method('PUT')
        @include('videojocs._form', ['videojoc' => $videojoc])
    </form>
@endsection
