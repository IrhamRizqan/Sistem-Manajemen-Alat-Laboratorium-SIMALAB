@extends('layouts.app')

@section('title', 'Kategori')

@section('content')
    <div class="border-bottom pb-3 mb-4 d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2">
        <div>
            <h1 class="h3 fw-bold mb-1">Daftar Kategori</h1>
            <p class="text-secondary mb-0">Kelola kategori barang laboratorium</p>
        </div>
        <a href="{{ route('categories.create') }}" class="btn btn-simalab">Tambah Kategori</a>
    </div>

    <form method="GET" action="{{ route('categories.index') }}" class="row g-2 mb-3">
        <div class="col-12 col-sm-6 col-md-4">
            <input type="text" name="q" value="{{ $search }}" class="form-control" placeholder="Cari nama atau deskripsi"
                aria-label="Cari kategori">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-simalab">Cari</button>
        </div>
        @if ($search !== '')
            <div class="col-auto">
                <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">Reset</a>
            </div>
        @endif
    </form>

    <div class="card">
        @if ($categories->isEmpty())
            <div class="card-body text-center py-5">
                @if ($search !== '')
                    <p class="fw-semibold mb-1">Kategori tidak ditemukan</p>
                    <p class="text-secondary small mb-3">Tidak ada hasil untuk kata kunci "{{ $search }}"</p>
                    <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary btn-sm">Reset pencarian</a>
                @else
                    <p class="fw-semibold mb-1">Belum ada data kategori</p>
                    <p class="text-secondary small mb-3">Tambahkan kategori pertama untuk mengelompokkan barang laboratorium</p>
                    <a href="{{ route('categories.create') }}" class="btn btn-simalab btn-sm">Tambah Kategori</a>
                @endif
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 60px;">No</th>
                            <th>Nama Kategori</th>
                            <th>Deskripsi</th>
                            <th class="text-end" style="width: 170px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $categories->firstItem() + $loop->index }}</td>
                                <td class="fw-semibold">{{ $category->name }}</td>
                                <td class="text-secondary">{{ $category->description ?: '-' }}</td>
                                <td class="text-end">
                                    <div class="d-inline-flex gap-1">
                                        <a href="{{ route('categories.edit', $category) }}"
                                            class="btn btn-outline-secondary btn-sm">Edit</a>
                                        <form method="POST" action="{{ route('categories.destroy', $category) }}"
                                            onsubmit="return confirm('Hapus kategori ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if ($categories->hasPages())
                <div class="card-footer bg-white">
                    {{ $categories->links() }}
                </div>
            @endif
        @endif
    </div>
@endsection