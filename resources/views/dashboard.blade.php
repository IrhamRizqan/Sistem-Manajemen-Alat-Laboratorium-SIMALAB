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
                <p class="fw-semibold mb-1">Data inventaris belum tersedia</p>
                <p class="text-secondary mb-0">-</p>
            </div>
        </div>
    </div>
</div>
@endsection
