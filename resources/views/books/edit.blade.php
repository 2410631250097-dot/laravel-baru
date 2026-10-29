
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
        <div style="color: red;">
            <p>Data belum valid. Periksa kembali:</p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('books.update', $book->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="title">Judul Buku:</label><br>
            <input
                type="text"
                name="title"
                id="title"
                value="{{ old('title', $book->title) }}"
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
                value="{{ old('author', $book->author) }}"
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
                value="{{ old('publisher', $book->publisher) }}"
            >
        </div>

        <br>

        <div>
            <label for="year">Tahun Terbit:</label><br>
            <input
                type="number"
                name="year"
                id="year"
                value="{{ old('year', $book->year) }}"
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
                value="{{ old('stock', $book->stock) }}"
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
                    <option
                        value="{{ $category->id }}"
                        @selected(
                            old('category_id', $book->category_id)
                            == $category->id
                        )
                    >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            @error('category_id')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <br>

        <button type="submit">Update Buku</button>
    </form>

    <br>

    <a href="{{ route('books.index') }}">Kembali ke Daftar Buku</a>
</body>
</html>
```