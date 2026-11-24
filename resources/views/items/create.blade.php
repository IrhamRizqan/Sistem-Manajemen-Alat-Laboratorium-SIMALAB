@extends('layouts.app')

@section('title', 'Tambah Barang')

@section('content')
    <div class="border-bottom pb-3 mb-4 d-flex justify-content-between align-items-center gap-2">
        <h1 class="h3 fw-bold mb-0">Tambah Barang</h1>
        <a href="{{ route('items.index') }}" class="btn btn-outline-secondary btn-sm">Kembali</a>
    </div>

    @if ($categories->isEmpty())
        <div class="alert alert-warning d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2"
            role="alert">
            <span>Belum ada kategori tersedia, tambahkan kategori terlebih dahulu</span>
            <a href="{{ route('categories.create') }}" class="btn btn-simalab btn-sm">Tambah Kategori</a>
        </div>
    @endif

    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card card-simalab">
                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">Periksa kembali isi formulir di bawah ini</div>
                    @endif

                    <form method="POST" action="{{ route('items.store') }}" novalidate>
                        @csrf

                        <div class="row g-3">
                            <div class="col-12 col-md-5">
                                <label for="code" class="form-label">Kode Barang</label>
                                <input id="code" type="text" name="code" value="{{ old('code') }}"
                                    class="form-control @error('code') is-invalid @enderror"
                                    placeholder="Contoh: LAB-NET-001" required autofocus>
                                @error('code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 col-md-7">
                                <label for="name" class="form-label">Nama Barang</label>
                                <input id="name" type="text" name="name" value="{{ old('name') }}"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Contoh: MikroTik RouterBoard hEX" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="category_id" class="form-label">Kategori</label>
                                <select id="category_id" name="category_id"
                                    class="form-select @error('category_id') is-invalid @enderror" required>
                                    <option value="">Pilih kategori</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="location" class="form-label">Lokasi Penyimpanan</label>
                                <input id="location" type="text" name="location" value="{{ old('location') }}"
                                    class="form-control @error('location') is-invalid @enderror"
                                    placeholder="Contoh: Lemari A, Lab Jaringan" required>
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="condition" class="form-label">Kondisi Barang</label>
                                <select id="condition" name="condition"
                                    class="form-select @error('condition') is-invalid @enderror" required>
                                    <option value="">Pilih kondisi</option>
                                    <option value="Baik" @selected(old('condition') === 'Baik')>Baik</option>
                                    <option value="Rusak Ringan" @selected(old('condition') === 'Rusak Ringan')>Rusak Ringan
                                    </option>
                                    <option value="Rusak Berat" @selected(old('condition') === 'Rusak Berat')>Rusak Berat
                                    </option>
                                </select>
                                @error('condition')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="stock" class="form-label">Jumlah Stok</label>
                                <input id="stock" type="number" name="stock" min="0" value="{{ old('stock', 1) }}"
                                    class="form-control @error('stock') is-invalid @enderror" required>
                                @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" class="btn btn-simalab">Simpan Barang</button>
                            <a href="{{ route('items.index') }}" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection