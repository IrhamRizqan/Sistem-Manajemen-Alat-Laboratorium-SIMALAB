@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')
    <div class="border-bottom pb-3 mb-4 d-flex justify-content-between align-items-center gap-2">
        <h1 class="h3 fw-bold mb-0">Edit Kategori</h1>
        <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary btn-sm">Kembali</a>
    </div>

    <div class="row">
        <div class="col-12 col-lg-7">
            <div class="card card-simalab">
                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">Periksa kembali isi formulir di bawah ini</div>
                    @endif

                    <form method="POST" action="{{ route('categories.update', $category) }}" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Kategori</label>
                            <input id="name" type="text" name="name" value="{{ old('name', $category->name) }}"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Contoh: Perangkat Jaringan" required autofocus>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label">Deskripsi (Opsional)</label>
                            <textarea id="description" name="description" rows="3"
                                class="form-control @error('description') is-invalid @enderror"
                                placeholder="Keterangan singkat jenis barang">{{ old('description', $category->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-simalab">Simpan Perubahan</button>
                            <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection