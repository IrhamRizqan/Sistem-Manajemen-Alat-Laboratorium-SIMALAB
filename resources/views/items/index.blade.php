@extends('layouts.app')

@section('title', 'Barang')

@section('content')
    <div class="border-bottom pb-3 mb-4 d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2">
        <div>
            <h1 class="h3 fw-bold mb-1">Daftar Barang</h1>
            <p class="text-secondary mb-0">Kelola data inventaris barang laboratorium</p>
        </div>
        <a href="{{ route('items.create') }}" class="btn btn-simalab">Tambah Barang</a>
    </div>

    <form method="GET" action="{{ route('items.index') }}" class="row g-2 mb-3">
        <div class="col-12 col-sm-5 col-md-4">
            <input type="text" name="q" value="{{ $search }}" class="form-control"
                placeholder="Cari kode, nama, atau lokasi" aria-label="Cari barang">
        </div>
        <div class="col-12 col-sm-4 col-md-3">
            <select name="category_id" class="form-select" aria-label="Filter kategori">
                <option value="">Semua Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected($categoryId == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-simalab">Filter</button>
        </div>
        @if ($search !== '' || !empty($categoryId))
            <div class="col-auto">
                <a href="{{ route('items.index') }}" class="btn btn-outline-secondary">Reset</a>
            </div>
        @endif
    </form>

    <div class="card">
        @if ($items->isEmpty())
            <div class="card-body text-center py-5">
                @if ($search !== '' || !empty($categoryId))
                    <p class="fw-semibold mb-1">Barang tidak ditemukan</p>
                    <p class="text-secondary small mb-3">Tidak ada barang yang cocok dengan pencarian atau filter yang dipilih</p>
                    <a href="{{ route('items.index') }}" class="btn btn-outline-secondary btn-sm">Reset filter</a>
                @else
                    <p class="fw-semibold mb-1">Belum ada data barang</p>
                    <p class="text-secondary small mb-3">Tambahkan barang pertama ke inventaris laboratorium</p>
                    <a href="{{ route('items.create') }}" class="btn btn-simalab btn-sm">Tambah Barang</a>
                @endif
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 60px;">No</th>
                            <th>Kode</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Lokasi</th>
                            <th>Kondisi</th>
                            <th>Stok</th>
                            <th class="text-end" style="width: 170px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $items->firstItem() + $loop->index }}</td>
                                <td class="fw-semibold">{{ $item->code }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->category->name }}</td>
                                <td class="text-secondary">{{ $item->location }}</td>
                                <td>
                                    @if ($item->condition === 'Baik')
                                        <span class="badge text-bg-success">Baik</span>
                                    @elseif ($item->condition === 'Rusak Ringan')
                                        <span class="badge badge-simalab">Rusak Ringan</span>
                                    @else
                                        <span class="badge text-bg-danger">Rusak Berat</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="fw-semibold">{{ $item->stock }}</span>
                                    @if ($item->stock <= 2)
                                        <span class="small text-danger ms-1">(Menipis)</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="d-inline-flex gap-1">
                                        <a href="{{ route('items.edit', $item) }}" class="btn btn-outline-secondary btn-sm">Edit</a>
                                        <form method="POST" action="{{ route('items.destroy', $item) }}"
                                            onsubmit="return confirm('Hapus barang ini?')">
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

            @if ($items->hasPages())
                <div class="card-footer bg-white">
                    {{ $items->links() }}
                </div>
            @endif
        @endif
    </div>
@endsection