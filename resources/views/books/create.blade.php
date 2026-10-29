
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
        <div style="color: red;">
            <p>Data belum valid. Periksa kembali isian berikut:</p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('books.store') }}" method="POST">
        @csrf

        <div>
            <label for="title">Judul Buku:</label><br>
            <input
                type="text"
                name="title"
                id="title"
                value="{{ old('title') }}"
                required
            >
        </div>

        <br>

        <div>
            <label for="author">Penulis:</label><br>
            <input
                type="text"
                name="author"
                id="author"
                value="{{ old('author') }}"
                required
            >
        </div>

        <br>

        <div>
            <label for="publisher">Penerbit:</label><br>
            <input
                type="text"
                name="publisher"
                id="publisher"
                value="{{ old('publisher') }}"
            >
        </div>

        <br>

        <div>
            <label for="year">Tahun Terbit:</label><br>
            <input
                type="number"
                name="year"
                id="year"
                value="{{ old('year') }}"
                min="1900"
                max="{{ date('Y') }}"
            >
        </div>

        <br>

        <div>
            <label for="stock">Stok Buku:</label><br>
            <input
                type="number"
                name="stock"
                id="stock"
                value="{{ old('stock', 0) }}"
                min="0"
                required
            >
        </div>

        <br>

        <div>
            <label for="category_id">Kategori:</label><br>
            <select name="category_id" id="category_id" required>
                <option value="">-- Pilih Kategori --</option>
                

            @foreach ($categories as $category)
                <option value="{{ $category->id }}">
                {{ $category->name }}
                </option>
            @endforeach
        </select>
        </div>SA

        <br>

        <button type="submit">Simpan Buku</button>
    </form>

    <br>

    <a href="{{ route('books.index') }}">
        Kembali ke Daftar Buku
    </a>
</body>
</html>
```