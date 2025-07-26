@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
<div class="content-wrapper">
    <h1 class="page-title">
        <i class="fas fa-plus me-3"></i>
        Tambah Kategori Baru
    </h1>

    <div class="row">
        <div class="col-md-6">
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

                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="nama_kategori" class="form-label">
                                <i class="fas fa-tag me-2"></i>
                                Nama Kategori
                            </label>
                            <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror" 
                                   id="nama_kategori" name="nama_kategori" value="{{ old('nama_kategori') }}" 
                                   placeholder="Contoh: Fiksi, Non-Fiksi, Teknologi" required>
                            <div class="form-text">
                                Masukkan nama kategori yang unik dan deskriptif
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>
                                Simpan Kategori
                            </button>
                            <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i>
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Panduan Kategori
                    </h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="fas fa-lightbulb me-2"></i>
                        <strong>Tips membuat kategori:</strong>
                        <ul class="mb-0 mt-2">
                            <li>Gunakan nama yang jelas dan mudah dipahami</li>
                            <li>Hindari nama yang terlalu panjang</li>
                            <li>Pastikan kategori tidak duplikat</li>
                            <li>Gunakan huruf kapital di awal kata</li>
                        </ul>
                    </div>

                    <div class="mt-3">
                        <h6>Contoh kategori yang baik:</h6>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge bg-secondary">Fiksi</span>
                            <span class="badge bg-secondary">Non-Fiksi</span>
                            <span class="badge bg-secondary">Teknologi</span>
                            <span class="badge bg-secondary">Sejarah</span>
                            <span class="badge bg-secondary">Sains</span>
                            <span class="badge bg-secondary">Biografi</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
