
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
</head>
<body>
    <h1>Tambah Buku</h1>

    @if ($errors->any())
        <ul style="color: red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('books.store') }}" method="POST" novalidate>
        @csrf

        <label>Judul Buku:</label><br>
        <input type="text" name="title"
            value="{{ old('title') }}">
        <br><br>

        <label>Penulis:</label><br>
        <input type="text" name="author"
            value="{{ old('author') }}">
        <br><br>

        <label>Penerbit:</label><br>
        <input type="text" name="publisher"
            value="{{ old('publisher') }}">
        <br><br>

        <label>Tahun Terbit:</label><br>
        <input type="number" name="year"
            value="{{ old('year') }}">
        <br><br>

        <label>Stok Buku:</label><br>
        <input type="number" name="stock"
            value="{{ old('stock', 0) }}">
        <br><br>

        <button type="submit">Simpan Buku</button>
    </form>

    <br>
    <a href="{{ route('books.index') }}">Kembali ke Daftar Buku</a>
</body>
</html>
