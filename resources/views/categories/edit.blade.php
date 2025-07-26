@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')
<div class="content-wrapper">
    <h1 class="page-title">
        <i class="fas fa-edit me-3"></i>
        Edit Kategori: {{ $category->nama_kategori }}
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

                    <form action="{{ route('categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="nama_kategori" class="form-label">
                                <i class="fas fa-tag me-2"></i>
                                Nama Kategori
                            </label>
                            <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror" 
                                   id="nama_kategori" name="nama_kategori" 
                                   value="{{ old('nama_kategori', $category->nama_kategori) }}" required>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>
                                Update Kategori
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
                        Informasi Kategori
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <small class="text-muted">Dibuat pada</small>
                        <p class="mb-0">{{ $category->created_at->format('d F Y') }}</p>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted">Terakhir diperbarui</small>
                        <p class="mb-0">{{ $category->updated_at->format('d F Y') }}</p>
                    </div>
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <small>
                            Mengubah nama kategori akan mempengaruhi semua buku yang menggunakan kategori ini.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
