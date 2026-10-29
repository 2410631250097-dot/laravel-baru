<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Menampilkan daftar buku beserta kategorinya
    public function index()
    {
        $books = Book::with('category')->get();

        return view('books.index', compact('books'));
    }

    // Menampilkan form tambah buku
    public function create()
    {
        $title = 'Tambah Buku';
        $categories = Category::orderBy('name')->get();

        return view('books.create', compact('title', 'categories'));
    }

    // Menyimpan buku baru dengan validasi kategori
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|integer|exists:categories,id',
        ]);

        Book::create($validated);

        return redirect()
            ->route('books.index')
            ->with('success', 'Buku berhasil ditambahkan.');
    }

    // Menampilkan detail buku
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    // Menampilkan form edit buku beserta pilihan kategori
    public function edit(Book $book)
    {
        $title = 'Edit Buku';
        $categories = Category::orderBy('name')->get();

        return view(
            'books.edit',
            compact('title', 'book', 'categories')
        );
    }

    // Memperbarui buku dengan validasi kategori
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|integer|exists:categories,id',
        ]);

        $book->update($validated);

        return redirect()
            ->route('books.index')
            ->with('success', 'Data buku berhasil diperbarui.');
    }

    // Menghapus buku
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()
            ->route('books.index')
            ->with('success', 'Buku berhasil dihapus.');
    }
}
