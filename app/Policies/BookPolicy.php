<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;

class BookPolicy
{
    /**
     * Menentukan apakah pengguna dapat melihat daftar buku.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'petugas']);
    }

    /**
     * Menentukan apakah pengguna dapat melihat detail buku.
     */
    public function view(User $user, Book $book): bool
    {
        return in_array($user->role, ['admin', 'petugas']);
    }

    /**
     * Menentukan apakah pengguna dapat menambahkan buku.
     */
    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'petugas']);
    }

    /**
     * Menentukan apakah pengguna dapat mengubah buku.
     */
    public function update(User $user, Book $book): bool
    {
        return in_array($user->role, ['admin', 'petugas']);
    }

    /**
     * Menentukan apakah pengguna dapat menghapus buku.
     */
    public function delete(User $user, Book $book): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Menentukan apakah pengguna dapat memulihkan buku.
     */
    public function restore(User $user, Book $book): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Menentukan apakah pengguna dapat menghapus buku secara permanen.
     */
    public function forceDelete(User $user, Book $book): bool
    {
        return $user->role === 'admin';
    }
}
