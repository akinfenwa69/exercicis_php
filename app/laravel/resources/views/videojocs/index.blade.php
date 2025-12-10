@extends('layout')

@section('title', 'Videojocs')

@section('content')

    <div style="display: flex; gap: 8px; align-items: center;">
        <h1 class="text-6xl font-bold">Videojocs</h1>
        <a class="btn"
            style="border-radius: 50%; height: 100%; aspect-ratio: 1/1; display:flex; align-items: center; justify-content: center;"
            href="{{ route('videojocs.create') }}">+</a>
    </div>

    <table border="1" cellpadding="6">
        <thead>
            <tr>
                @foreach ($headers as $h)
                    <th>{{ $h }}</th>
                @endforeach
                <th>Accions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($videojocs as $l)
                <tr>
                    <td>{{ $l->id }}</td>
                    <td>{{ $l->nom }}</td>
                    <td>{{ $l->plataforma }}</td>
                    <td>{{ $l->any_estrena }}</td>
                    <td>{{ ucfirst($l->estat) }}</td>
                    <td>{{ number_format($l->preu, 2, ',', '.') }} €</td>
                    <td>
                        <a class="btn" href="{{ route('videojocs.edit', $l) }}">Editar</a>
                        <form action="{{ route('videojocs.destroy', $l) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn" type="submit"
                                onclick="return confirm('Eliminar aquest videojoc?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $videojocs->links() }}

@endsection
