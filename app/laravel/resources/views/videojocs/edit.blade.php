@extends('layout')

@section('title', 'Editar llibre')

@section('content')
    <h1>Editar llibre</h1>
    <form method="POST" action="{{ route('llibres.update', $llibre) }}">
        @method('PUT')
        @include('llibres._form', ['llibre' => $llibre])
    </form>
@endsection
