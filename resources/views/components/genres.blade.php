<select name="genre" class="w-full border rounded px-3 py-2" required>
    <option value="">-- Select Genre --</option>
    @foreach($genres as $genre)
        <option value="{{ $genre->id }}" {{ old('genre') == $genre->id ? 'selected' : '' }}>
            {{ $genre->name }}
        </option>
    @endforeach
</select>