
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku</title>
</head>
<body>
    <h1>Daftar Buku</h1>

    @if (session('success'))
        <p style="color: green;">
            {{ session('success') }}
        </p>
    @endif

    <a href="{{ route('books.create') }}">+ Tambah Buku</a>

    <br><br>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>No.</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Tahun Terbit</th>
                <th>Stok</th>
                <th>Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($books as $book)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->publisher ?? '-' }}</td>
                    <td>{{ $book->year ?? '-' }}</td>
                    <td>{{ $book->stock }}</td>

                    <td>
                        {{ $book->category?->name ?? 'Belum ada kategori' }}
                    </td>

                    <td>
                        <a href="{{ route('books.show', $book->id) }}">
                            Detail
                        </a>
                        |
                        <a href="{{ route('books.edit', $book->id) }}">
                            Edit
                        </a>

                        <form
                            action="{{ route('books.destroy', $book->id) }}"
                            method="POST"
                            style="display: inline;"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                onclick="return confirm('Yakin ingin menghapus buku ini?')"
                            >
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">Belum ada data buku.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
```