
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
</head>
<body>
    <h1>Edit Buku</h1>

    @if ($errors->any())
        <ul style="color: red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('books.update', $book->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Judul Buku:</label><br>
        <input type="text" name="judul"
               value="{{ old('judul', $book->judul) }}" required>
        <br><br>

        <label>Penulis:</label><br>
        <input type="text" name="penulis"
               value="{{ old('penulis', $book->penulis) }}" required>
        <br><br>

        <label>Penerbit:</label><br>
        <input type="text" name="penerbit"
               value="{{ old('penerbit', $book->penerbit) }}">
        <br><br>

        <label>Tahun Terbit:</label><br>
        <input type="number" name="tahun_terbit"
               min="1900" max="{{ date('Y') }}"
               value="{{ old('tahun_terbit', $book->tahun_terbit) }}">
        <br><br>

        <label>Stok Buku:</label><br>
        <input type="number" name="stok"
               min="0" value="{{ old('stok', $book->stok) }}" required>
        <br><br>

        <button type="submit">Update Buku</button>
    </form>

    <br>
    <a href="{{ route('books.index') }}">Kembali ke Daftar Buku</a>
</body>
</html>
