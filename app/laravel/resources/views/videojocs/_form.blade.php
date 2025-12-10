@csrf

<label>Nom
    <input type="text" name="nom" value="{{ old('nom', $videojoc->nom ?? '') }}">
</label>
@error('nom')
    <div>{{ $message }}</div>
@enderror
<br>

<label>Plataforma
    <input type="text" name="plataforma" value="{{ old('plataforma', $videojoc->plataforma ?? '') }}">
</label>
@error('plataforma')
    <div>{{ $message }}</div>
@enderror
<br>

<label>Any d'estrena
    <input type="number" name="any_estrena" value="{{ old('any_estrena', $videojoc->any_estrena ?? date('Y')) }}">
</label>
@error('any_estrena')
    <div>{{ $message }}</div>
@enderror
<br>

<label>Estat
    <select name="estat">
        @php $estat = old('estat', $videojoc->estat ?? 'Jugant'); @endphp
        <option value="Jugant" {{ $estat === 'Jugant' ? 'selected' : '' }}>Jugant</option>
        <option value="Completat" {{ $estat === 'Completat' ? 'selected' : '' }}>Completat</option>
        <option value="Pendent" {{ $estat === 'Pendent' ? 'selected' : '' }}>Pendent</option>
    </select>
</label>
@error('estat')
    <div>{{ $message }}</div>
@enderror
<br>

<label>Preu
    <input type="number" step="0.01" name="preu" value="{{ old('preu', $videojoc->preu ?? 0) }}">
</label>
@error('preu')
    <div>{{ $message }}</div>
@enderror
<br><br>

<button type="submit">Guardar</button>
<a href="{{ route('videojocs.index') }}">Tornar</a>
