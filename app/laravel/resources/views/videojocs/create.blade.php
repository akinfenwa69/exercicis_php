@extends('layout')

@section('title', 'Afegir llibre')

@section('content')
    <h1>Afegir llibre</h1>
    <form method="POST" action="{{ route('llibres.store') }}">
        @include('llibres._form')
    </form>
@endsection
