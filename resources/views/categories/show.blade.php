@extends('layouts.app')

@section('title', 'Detail Kategori')

@section('content')
<div class="content-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="page-title mb-0">
            <i class="fas fa-tag me-3"></i>
            Kategori: {{ $category->nama_kategori }}
        </h1>
        <div>
            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">
                <i class="fas fa-edit me-2"></i>
                Edit
            </a>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>
                Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Informasi Kategori
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <small class="text-muted">Nama Kategori</small>
                        <p class="mb-0 fw-bold">{{ $category->nama_kategori }}</p>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted">Jumlah Buku</small>
                        <p class="mb-0">
                            <span class="badge bg-primary fs-6">
                                {{ $category->bukus->count() }} buku
                            </span>
                        </p>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted">Dibuat pada</small>
                        <p class="mb-0">{{ $category->created_at->format('d F Y') }}</p>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted">Terakhir diperbarui</small>
                        <p class="mb-0">{{ $category->updated_at->format('d F Y') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-book me-2"></i>
                        Buku dalam Kategori Ini
                    </h5>
                </div>
                <div class="card-body">
                    @if($category->bukus->count() > 0)
                        <div class="row">
                            @foreach($category->bukus as $book)
                                <div class="col-md-6 mb-3">
                                    <div class="card book-card h-100">
                                        <div class="card-body">
                                            <h6 class="card-title">{{ $book->judul }}</h6>
                                            <p class="card-text">
                                                <small class="text-muted">
                                                    <i class="fas fa-user me-1"></i>
                                                    {{ $book->penulis }}
                                                </small>
                                                <br>
                                                <small class="text-muted">
                                                    <i class="fas fa-building me-1"></i>
                                                    {{ $book->penerbit }}
                                                </small>
                                            </p>
                                            <div class="mb-2">
                                                @if($book->stok > 0)
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-check me-1"></i>
                                                        Tersedia ({{ $book->stok }})
                                                    </span>
                                                @else
                                                    <span class="badge bg-danger">
                                                        <i class="fas fa-times me-1"></i>
                                                        Tidak Tersedia
                                                    </span>
                                                @endif
                                            </div>
                                            <a href="{{ route('books.show', $book->id) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye me-1"></i>
                                                Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-book fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Belum ada buku</h5>
                            <p class="text-muted">Belum ada buku yang menggunakan kategori ini</p>
                            <a href="{{ route('books.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>
                                Tambah Buku
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
