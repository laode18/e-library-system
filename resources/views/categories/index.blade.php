@extends('layouts.app')

@section('title', 'Daftar Kategori')

@section('content')
<div class="content-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="page-title mb-0">
            <i class="fas fa-tags me-3"></i>
            Daftar Kategori
        </h1>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>
            Tambah Kategori
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            @if($categories->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th>Nama Kategori</th>
                                <th width="15%">Jumlah Buku</th>
                                <th width="15%">Dibuat</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $index => $category)
                            <tr>
                                <td>{{ $categories->firstItem() + $index }}</td>
                                <td>
                                    <i class="fas fa-tag me-2"></i>
                                    <strong>{{ $category->nama_kategori }}</strong>
                                </td>
                                <td>
                                    <span class="badge bg-primary">
                                        {{ $category->bukus_count }} buku
                                    </span>
                                </td>
                                <td>
                                    <small class="text-muted">
                                        {{ $category->created_at->format('d/m/Y') }}
                                    </small>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('categories.show', $category->id) }}" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('categories.edit', $category->id) }}" 
                                           class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('categories.destroy', $category->id) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Yakin ingin menghapus kategori ini? Semua buku dalam kategori ini akan ikut terhapus!')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $categories->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-tags fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">Belum ada kategori</h4>
                    <p class="text-muted">Mulai dengan menambahkan kategori pertama</p>
                    <a href="{{ route('categories.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>
                        Tambah Kategori Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
