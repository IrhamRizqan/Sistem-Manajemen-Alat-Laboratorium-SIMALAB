@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <div class="border-bottom pb-3 mb-4">
        <h1 class="h3 fw-bold mb-1">Dashboard SIMALAB</h1>
        <p class="text-secondary mb-0">Selamat datang, {{ $user->name }}</p>
    </div>

    <div class="row g-4">
        <div class="col-12 col-lg-5">
            <div class="card card-simalab h-100">
                <div class="card-header bg-white fw-semibold">Informasi Petugas Aktif</div>
                <div class="card-body">
                    <dl class="row mb-0 gy-2">
                        <dt class="col-sm-5 text-secondary fw-normal">Nama Petugas</dt>
                        <dd class="col-sm-7 mb-0 fw-semibold">{{ $user->name }}</dd>

                        <dt class="col-sm-5 text-secondary fw-normal">Email</dt>
                        <dd class="col-sm-7 mb-0">{{ $user->email }}</dd>

                        <dt class="col-sm-5 text-secondary fw-normal">Petugas Terdaftar</dt>
                        <dd class="col-sm-7 mb-0 fw-semibold">{{ $totalPetugas }} akun</dd>
                    </dl>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-7">
            <div class="card h-100">
                <div class="card-header bg-white fw-semibold">Status Inventaris</div>
                <div class="card-body">
                    <dl class="row mb-3 gy-2">
                        <dt class="col-sm-5 text-secondary fw-normal">Total Kategori</dt>
                        <dd class="col-sm-7 mb-0 fw-semibold">{{ $totalKategori }} kategori</dd>

                        <dt class="col-sm-5 text-secondary fw-normal">Total Jenis Barang</dt>
                        <dd class="col-sm-7 mb-0 fw-semibold">{{ $totalBarang }} barang</dd>

                        <dt class="col-sm-5 text-secondary fw-normal">Total Unit Stok</dt>
                        <dd class="col-sm-7 mb-0 fw-semibold">{{ $totalStok }} unit</dd>
                    </dl>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('items.index') }}" class="btn btn-simalab btn-sm">Kelola Barang</a>
                        <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary btn-sm">Kelola
                            Kategori</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header bg-white fw-semibold">Barang Perlu Perhatian</div>
        @if ($barangPerhatian->isEmpty())
            <div class="card-body text-secondary">Semua barang dalam kondisi baik dan stok aman</div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Kode</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Kondisi</th>
                            <th>Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barangPerhatian as $item)
                            <tr>
                                <td class="fw-semibold">{{ $item->code }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->category->name }}</td>
                                <td>
                                    @if ($item->condition === 'Baik')
                                        <span class="badge text-bg-success">Baik</span>
                                    @elseif ($item->condition === 'Rusak Ringan')
                                        <span class="badge badge-simalab">Rusak Ringan</span>
                                    @else
                                        <span class="badge text-bg-danger">Rusak Berat</span>
                                    @endif
                                </td>
                                <td class="fw-semibold">{{ $item->stock }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection