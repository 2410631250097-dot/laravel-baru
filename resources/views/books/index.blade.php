
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku - Perpustakaan</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        h2 {
            margin: 0;
            color: #333;
        }

        .btn {
            display: inline-block;
            padding: 9px 14px;
            border: none;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-add {
            background: #2563eb;
        }

        .btn-edit {
            background: #e6a23c;
        }

        .btn-delete {
            background: #dc3545;
        }

        .btn-logout {
            background: #6c757d;
        }

        .btn-users {
            background: #198754;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background: #2563eb;
            color: white;
        }

        tr:nth-child(even) {
            background: #f8f9fa;
        }

        .actions {
            display: flex;
            gap: 6px;
            align-items: center;
        }

        .actions form {
            margin: 0;
        }

        .empty {
            text-align: center;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="header">
            <h2>Daftar Buku</h2>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-logout">
                    Logout
                </button>
            </form>
        </div>

        {{-- Menu pengelolaan pengguna khusus Admin --}}
        @can('manage-users')
            <a href="{{ route('users.index') }}" class="btn btn-users">
                Pengelolaan Pengguna
            </a>
        @endcan

        {{-- Tombol tambah buku --}}
        @can('create', \App\Models\Book::class)
            <a href="{{ route('books.create') }}" class="btn btn-add">
                + Tambah Buku
            </a>
        @endcan

        <table>
            <thead>
                <tr>
                    <th>No</th>
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
                        <td>{{ $book->year }}</td>
                        <td>{{ $book->stock }}</td>
                        <td>
                            {{ $book->category->name ?? 'Belum ada kategori' }}
                        </td>
                        <td>
                            <div class="actions">

                                {{-- Tombol edit --}}
                                @can('update', $book)
                                    <a href="{{ route('books.edit', $book->id) }}"
                                       class="btn btn-edit">
                                        Edit
                                    </a>
                                @endcan

                                {{-- Tombol hapus khusus Admin --}}
                                @can('delete', $book)
                                    <form action="{{ route('books.destroy', $book->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-delete">
                                            Hapus
                                        </button>
                                    </form>
                                @endcan

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="empty">
                            Belum ada data buku.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</body>
</html>
