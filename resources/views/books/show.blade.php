
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Buku</title>
</head>
<body>
    <h1>Detail Buku</h1>

    <p><strong>Judul:</strong> {{ $book->judul }}</p>
    <p><strong>Penulis:</strong> {{ $book->penulis }}</p>
    <p><strong>Penerbit:</strong> {{ $book->penerbit ?? '-' }}</p>
    <p><strong>Tahun Terbit:</strong> {{ $book->tahun_terbit ?? '-' }}</p>

    <a href="{{ route('books.edit', $book->id) }}">Edit Buku</a>
    |
    <a href="{{ route('books.index') }}">Kembali ke Daftar Buku</a>
</body>
</html>
