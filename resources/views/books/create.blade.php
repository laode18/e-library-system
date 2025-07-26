@extends('layouts.app')

@section('title', 'Tambah Buku')

@section('content')
<div class="content-wrapper">
    <h1 class="page-title">
        <i class="fas fa-plus me-3"></i>
        Tambah Buku Baru
    </h1>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <strong>Terjadi kesalahan:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('books.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="judul" class="form-label">
                                <i class="fas fa-book me-2"></i>
                                Judul Buku
                            </label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" 
                                   id="judul" name="judul" value="{{ old('judul') }}" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="penulis" class="form-label">
                                        <i class="fas fa-user me-2"></i>
                                        Penulis
                                    </label>
                                    <input type="text" class="form-control @error('penulis') is-invalid @enderror" 
                                           id="penulis" name="penulis" value="{{ old('penulis') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="penerbit" class="form-label">
                                        <i class="fas fa-building me-2"></i>
                                        Penerbit
                                    </label>
                                    <input type="text" class="form-control @error('penerbit') is-invalid @enderror" 
                                           id="penerbit" name="penerbit" value="{{ old('penerbit') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="kategori_id" class="form-label">
                                        <i class="fas fa-tag me-2"></i>
                                        Kategori
                                    </label>
                                    <select class="form-select @error('kategori_id') is-invalid @enderror" 
                                            id="kategori_id" name="kategori_id" required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" 
                                                    {{ old('kategori_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->nama_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="stok" class="form-label">
                                        <i class="fas fa-boxes me-2"></i>
                                        Stok
                                    </label>
                                    <input type="number" class="form-control @error('stok') is-invalid @enderror" 
                                           id="stok" name="stok" value="{{ old('stok', 1) }}" min="0" required>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>
                                Simpan Buku
                            </button>
                            <a href="{{ route('books.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i>
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Panduan
                    </h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="fas fa-lightbulb me-2"></i>
                        <strong>Tips:</strong>
                        <ul class="mb-0 mt-2">
                            <li>Pastikan judul buku ditulis dengan benar</li>
                            <li>Gunakan nama lengkap penulis</li>
                            <li>Pilih kategori yang sesuai</li>
                            <li>Masukkan jumlah stok yang tersedia</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
