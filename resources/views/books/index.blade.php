@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')
<div class="content-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="page-title mb-0">
            <i class="fas fa-book me-3"></i>
            Daftar Buku
        </h1>
        @if(auth()->user()->isAdmin())
            <a href="{{ route('books.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>
                Tambah Buku
            </a>
        @endif
    </div>

    <!-- Search and Filter -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('books.index') }}">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" class="form-control" name="search" 
                                   placeholder="Cari judul, penulis, atau penerbit..." 
                                   value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <select class="form-select" name="kategori">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" 
                                        {{ request('kategori') == $category->id ? 'selected' : '' }}>
                                    {{ $category->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-filter me-2"></i>
                            Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Books Grid -->
    @if($books->count() > 0)
        <div class="row">
            @foreach($books as $book)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card book-card h-100">
                        <div class="card-body d-flex flex-column">
                            <div class="text-center mb-3">
                                <i class="fas fa-book fa-3x text-primary mb-2"></i>
                            </div>
                            
                            <h6 class="card-title fw-bold">{{ $book->judul }}</h6>
                            
                            <div class="mb-2">
                                <small class="text-muted">
                                    <i class="fas fa-user me-1"></i>
                                    {{ $book->penulis }}
                                </small>
                            </div>
                            
                            <div class="mb-2">
                                <small class="text-muted">
                                    <i class="fas fa-building me-1"></i>
                                    {{ $book->penerbit }}
                                </small>
                            </div>
                            
                            <div class="mb-3">
                                <span class="badge bg-secondary">
                                    <i class="fas fa-tag me-1"></i>
                                    {{ $book->kategori->nama_kategori }}
                                </span>
                            </div>
                            
                            <div class="mb-3">
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
                            
                            <div class="mt-auto">
                                <div class="d-grid gap-2">
                                    <a href="{{ route('books.show', $book->id) }}" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-eye me-1"></i>
                                        Detail
                                    </a>
                                    
                                    @if(auth()->user()->isUser() && $book->stok > 0)
                                        <form action="{{ route('borrowings.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="buku_id" value="{{ $book->id }}">
                                            <button type="submit" class="btn btn-success btn-sm w-100"
                                                    onclick="return confirm('Yakin ingin meminjam buku ini?')">
                                                <i class="fas fa-hand-holding me-1"></i>
                                                Pinjam
                                            </button>
                                        </form>
                                    @endif
                                    
                                    @if(auth()->user()->isAdmin())
                                        <div class="btn-group w-100" role="group">
                                            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Yakin ingin menghapus buku ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $books->appends(request()->query())->links() }}
        </div>
    @else
        <div class="text-center py-5">
            <i class="fas fa-search fa-3x text-muted mb-3"></i>
            <h4 class="text-muted">Tidak ada buku ditemukan</h4>
            <p class="text-muted">Coba ubah kata kunci pencarian atau filter kategori</p>
            @if(auth()->user()->isAdmin())
                <a href="{{ route('books.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>
                    Tambah Buku Pertama
                </a>
            @endif
        </div>
    @endif
</div>
@endsection
