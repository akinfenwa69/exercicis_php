@csrf

<label>Títol
    <input type="text" name="titol" value="{{ old('titol', $llibre->titol ?? '') }}">
</label>
@error('titol')
    <div>{{ $message }}</div>
@enderror
<br>

<label>Autor
    <input type="text" name="autor" value="{{ old('autor', $llibre->autor ?? '') }}">
</label>
@error('autor')
    <div>{{ $message }}</div>
@enderror
<br>

<label>Any edició
    <input type="number" name="any_edicio" value="{{ old('any_edicio', $llibre->any_edicio ?? date('Y')) }}">
</label>
@error('any_edicio')
    <div>{{ $message }}</div>
@enderror
<br>

<label>Estat
    <select name="estat">
        @php $estat = old('estat', $llibre->estat ?? 'disponible'); @endphp
        <option value="disponible" {{ $estat === 'disponible' ? 'selected' : '' }}>Disponible</option>
        <option value="prestat" {{ $estat === 'prestat' ? 'selected' : '' }}>Prestat</option>
    </select>
</label>
@error('estat')
    <div>{{ $message }}</div>
@enderror
<br>

<label>Preu
    <input type="number" step="0.01" name="preu" value="{{ old('preu', $llibre->preu ?? 0) }}">
</label>
@error('preu')
    <div>{{ $message }}</div>
@enderror
<br><br>

<button type="submit">Guardar</button>
<a href="{{ route('llibres.index') }}">Tornar</a>
