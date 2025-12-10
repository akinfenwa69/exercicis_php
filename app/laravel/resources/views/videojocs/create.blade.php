@extends('layout')

@section('title', 'Afegir videojoc')

@section('content')
    <h1>Afegir videojoc</h1>
    <form method="POST" action="{{ route('videojocs.store') }}">
        @include('videojocs._form')
    </form>
@endsection
