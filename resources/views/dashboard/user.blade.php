@extends('layouts.app')

@section('title', 'User Dashboard')

@section('content')
<div class="content-wrapper">
    <h1 class="page-title">
        <i class="fas fa-tachometer-alt me-3"></i>
        Dashboard
    </h1>

    <!-- Welcome Message -->
    <div class="alert alert-info mb-4">
        <i class="fas fa-info-circle me-2"></i>
        Selamat datang, <strong>{{ auth()->user()->name }}</strong>! 
        Jelajahi koleksi buku kami dan mulai membaca hari ini.
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="stats-card warning">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-0">{{ $stats['borrowed_books'] }}</h3>
                        <p class="mb-0">Sedang Dipinjam</p>
                    </div>
                    <i class="fas fa-hand-holding fa-2x opacity-75"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="stats-card success">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-0">{{ $stats['returned_books'] }}</h3>
                        <p class="mb-0">Sudah Dikembalikan</p>
                    </div>
                    <i class="fas fa-check-circle fa-2x opacity-75"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="stats-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-0">{{ $stats['total_books'] }}</h3>
                        <p class="mb-0">Total Buku Tersedia</p>
                    </div>
                    <i class="fas fa-book fa-2x opacity-75"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-bolt me-2"></i>
                        Aksi Cepat
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('books.index') }}" class="btn btn-primary w-100">
                                <i class="fas fa-search me-2"></i>
                                Cari Buku
                            </a>
                        </div>
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('borrowings.index') }}" class="btn btn-info w-100">
                                <i class="fas fa-history me-2"></i>
                                Riwayat Peminjaman
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Borrowings -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-clock me-2"></i>
                        Peminjaman Terbaru
                    </h5>
                    <a href="{{ route('borrowings.index') }}" class="btn btn-sm btn-outline-primary">
                        Lihat Semua
                    </a>
                </div>
                <div class="card-body">
                    @if($recentBorrowings->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Buku</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Tanggal Kembali</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentBorrowings as $borrowing)
                                    <tr>
                                        <td>
                                            <i class="fas fa-book me-2"></i>
                                            {{ $borrowing->buku->judul }}
                                        </td>
                                        <td>
                                            <i class="fas fa-calendar me-2"></i>
                                            {{ $borrowing->tanggal_pinjam->format('d/m/Y') }}
                                        </td>
                                        <td>
                                            @if($borrowing->tanggal_kembali)
                                                <i class="fas fa-calendar-check me-2"></i>
                                                {{ $borrowing->tanggal_kembali->format('d/m/Y') }}
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($borrowing->status == 'dipinjam')
                                                <span class="badge bg-warning">
                                                    <i class="fas fa-clock me-1"></i>
                                                    Dipinjam
                                                </span>
                                            @else
                                                <span class="badge bg-success">
                                                    <i class="fas fa-check me-1"></i>
                                                    Dikembalikan
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($borrowing->status == 'dipinjam')
                                                <form action="{{ route('borrowings.return', $borrowing->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-sm btn-success" 
                                                            onclick="return confirm('Yakin ingin mengembalikan buku ini?')">
                                                        <i class="fas fa-undo me-1"></i>
                                                        Kembalikan
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Belum ada peminjaman</p>
                            <a href="{{ route('books.index') }}" class="btn btn-primary">
                                <i class="fas fa-search me-2"></i>
                                Mulai Cari Buku
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
