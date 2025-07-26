@extends('layouts.app')

@section('title', 'Semua Peminjaman')

@section('content')
<div class="content-wrapper">
    <h1 class="page-title">
        <i class="fas fa-list-alt me-3"></i>
        Semua Peminjaman
    </h1>

    <div class="card">
        <div class="card-body">
            @if($borrowings->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th>Peminjam</th>
                                <th>Buku</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Status</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($borrowings as $index => $borrowing)
                            <tr>
                                <td>{{ $borrowings->firstItem() + $index }}</td>
                                <td>
                                    <i class="fas fa-user me-2"></i>
                                    <strong>{{ $borrowing->user->name }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $borrowing->user->email }}</small>
                                </td>
                                <td>
                                    <i class="fas fa-book me-2"></i>
                                    <strong>{{ $borrowing->buku->judul }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $borrowing->buku->penulis }}</small>
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

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $borrowings->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">Belum ada peminjaman</h4>
                    <p class="text-muted">Belum ada aktivitas peminjaman dari pengguna</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
