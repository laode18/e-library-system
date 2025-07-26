<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kategori;
use App\Models\Buku;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@library.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create regular user
        User::create([
            'name' => 'Regular User',
            'email' => 'user@library.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // Create categories
        $kategoris = [
            ['nama_kategori' => 'Fiksi'],
            ['nama_kategori' => 'Non-Fiksi'],
            ['nama_kategori' => 'Teknologi'],
            ['nama_kategori' => 'Sejarah'],
            ['nama_kategori' => 'Sains'],
        ];

        foreach ($kategoris as $kategori) {
            Kategori::create($kategori);
        }

        // Create sample books
        $bukus = [
            [
                'judul' => 'Laravel: Up & Running',
                'penulis' => 'Matt Stauffer',
                'penerbit' => 'O\'Reilly Media',
                'kategori_id' => 3,
                'stok' => 5,
            ],
            [
                'judul' => 'Clean Code',
                'penulis' => 'Robert C. Martin',
                'penerbit' => 'Prentice Hall',
                'kategori_id' => 3,
                'stok' => 3,
            ],
            [
                'judul' => 'The Great Gatsby',
                'penulis' => 'F. Scott Fitzgerald',
                'penerbit' => 'Scribner',
                'kategori_id' => 1,
                'stok' => 7,
            ],
            [
                'judul' => 'Sapiens',
                'penulis' => 'Yuval Noah Harari',
                'penerbit' => 'Harper',
                'kategori_id' => 4,
                'stok' => 4,
            ],
            [
                'judul' => 'A Brief History of Time',
                'penulis' => 'Stephen Hawking',
                'penerbit' => 'Bantam',
                'kategori_id' => 5,
                'stok' => 2,
            ],
        ];

        foreach ($bukus as $buku) {
            Buku::create($buku);
        }
    }
}
