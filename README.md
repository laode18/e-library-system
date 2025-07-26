# 📚 Laravel Web Service Sistem Perpustakaan

Proyek ini adalah implementasi sistem backend **Web Service Perpustakaan** menggunakan **Laravel** dan **RESTful API**, lengkap dengan autentikasi berbasis token menggunakan **Laravel Sanctum**. Sistem ini mendukung dua jenis pengguna: **Admin** dan **User**, dengan hak akses berbeda.

---

## 🚀 Fitur

### 🔐 Autentikasi
- Register
- Login
- Logout (Token-based with Sanctum)

### 🛠️ Fitur Admin
- Melihat semua data buku
- Menambah, mengedit, menghapus buku
- Mengelola kategori buku (CRUD)
- Melihat semua data peminjaman dari user

### 👤 Fitur User
- Melihat daftar buku
- Melakukan peminjaman buku
- Melihat riwayat peminjaman pribadi

---

## 🧱 Struktur Tabel Database

### users
| Kolom         | Tipe         |
|---------------|--------------|
| id            | bigIncrements|
| name          | string       |
| email         | string       |
| password      | string       |
| role          | enum('admin','user') |

### bukus
| Kolom         | Tipe         |
|---------------|--------------|
| id            | bigIncrements|
| judul         | string       |
| penulis       | string       |
| penerbit      | string       |
| kategori_id   | foreign key  |
| stok          | integer      |

### kategoris
| Kolom         | Tipe         |
|---------------|--------------|
| id            | bigIncrements|
| nama_kategori | string       |

### peminjamans
| Kolom            | Tipe         |
|------------------|--------------|
| id               | bigIncrements|
| user_id          | foreign key  |
| buku_id          | foreign key  |
| tanggal_pinjam   | date         |
| tanggal_kembali  | date         |
| status           | enum('dipinjam','dikembalikan') |

---

## 🧪 API Endpoint

### Auth
| Method | Endpoint        | Deskripsi         |
|--------|------------------|-------------------|
| POST   | /api/register    | Register user     |
| POST   | /api/login       | Login user        |
| POST   | /api/logout      | Logout user       |

### Buku
| Method | Endpoint        | Hak Akses | Deskripsi               |
|--------|------------------|-----------|--------------------------|
| GET    | /api/buku        | Semua     | Lihat semua buku         |
| POST   | /api/buku        | Admin     | Tambah buku              |
| PUT    | /api/buku/{id}   | Admin     | Edit buku                |
| DELETE | /api/buku/{id}   | Admin     | Hapus buku               |

### Kategori
| Method | Endpoint            | Hak Akses | Deskripsi               |
|--------|----------------------|-----------|--------------------------|
| GET    | /api/kategori        | Semua     | Lihat semua kategori     |
| POST   | /api/kategori        | Admin     | Tambah kategori          |
| PUT    | /api/kategori/{id}   | Admin     | Edit kategori            |
| DELETE | /api/kategori/{id}   | Admin     | Hapus kategori           |

### Peminjaman
| Method | Endpoint          | Hak Akses | Deskripsi                        |
|--------|--------------------|-----------|----------------------------------|
| POST   | /api/peminjaman    | User      | Peminjaman buku                  |
| GET    | /api/peminjaman    | Admin/User| Admin: semua, User: milik sendiri|

---

## ⚙️ Instalasi Proyek

```bash
# Clone repository
git clone https://github.com/username/library-system.git
cd library-system

# Install dependency
composer install

# Copy file .env
cp .env.example .env

# Generate app key
php artisan key:generate

# Setup database di .env
# DB_DATABASE=library_system

# Jalankan migrasi & seeder
php artisan migrate --seed

# Jalankan server
php artisan serve
