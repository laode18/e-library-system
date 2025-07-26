@extends('layouts.app')

@section('title', $book->judul)

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <i class="fas fa-book fa-4x text-primary mb-3"></i>
                        <h1 class="card-title">{{ $book->judul }}</h1>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-muted">Penulis</h6>
                            <p class="mb-3">
                                <i class="fas fa-user me-2"></i>
                                {{ $book->penulis }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Penerbit</h6>
                            <p class="mb-3">
                                <i class="fas fa-building me-2"></i>
                                {{ $book->penerbit }}
                            </p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-muted">Kategori</h6>
                            <p class="mb-3">
                                <span class="badge bg-secondary fs-6">
                                    <i class="fas fa-tag me-1"></i>
                                    {{ $book->kategori->nama_kategori }}
                                </span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Ketersediaan</h6>
                            <p class="mb-3">
                                @if($book->stok > 0)
                                    <span class="badge bg-success fs-6">
                                        <i class="fas fa-check me-1"></i>
                                        Tersedia ({{ $book->stok }} eksemplar)
                                    </span>
                                @else
                                    <span class="badge bg-danger fs-6">
                                        <i class="fas fa-times me-1"></i>
                                        Tidak Tersedia
                                    </span>
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('books.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>
                            Kembali
                        </a>

                        @if(auth()->user()->isUser() && $book->stok > 0)
                            <form action="{{ route('borrowings.store') }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="buku_id" value="{{ $book->id }}">
                                <button type="submit" class="btn btn-success"
                                        onclick="return confirm('Yakin ingin meminjam buku ini?')">
                                    <i class="fas fa-hand-holding me-2"></i>
                                    Pinjam Buku
                                </button>
                            </form>
                        @endif

                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit me-2"></i>
                                Edit
                            </a>
                            <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Yakin ingin menghapus buku ini?')">
                                    <i class="fas fa-trash me-2"></i>
                                    Hapus
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Informasi Tambahan
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <small class="text-muted">Ditambahkan pada</small>
                        <p class="mb-0">{{ $book->created_at->format('d F Y') }}</p>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted">Terakhir diperbarui</small>
                        <p class="mb-0">{{ $book->updated_at->format('d F Y') }}</p>
                    </div>
                    @if(auth()->user()->isUser())
                        <div class="alert alert-info">
                            <i class="fas fa-lightbulb me-2"></i>
                            <small>
                                Pastikan untuk mengembalikan buku tepat waktu agar pengguna lain juga bisa menikmatinya!
                            </small>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
