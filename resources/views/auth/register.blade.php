@extends('layouts.guest')

@section('title', 'Daftar Petugas')

@section('content')
    <div class="card card-simalab shadow-sm">
        <div class="card-body p-4">
            <h1 class="h4 fw-bold mb-1">Daftar Petugas</h1>
            <p class="text-secondary small mb-4">Buat akun baru untuk mengakses sistem inventaris laboratorium</p>

            @if ($errors->any())
                <div class="alert alert-danger" role="alert">Periksa kembali isi formulir di bawah ini</div>
            @endif

            <form method="POST" action="{{ route('register') }}" novalidate>
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}"
                        class="form-control @error('name') is-invalid @enderror" placeholder="Nama lengkap anda" required
                        autofocus autocomplete="name">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                        class="form-control @error('email') is-invalid @enderror" placeholder="nama@simalab.test" required
                        autocomplete="email">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <input id="password" type="password" name="password"
                        class="form-control @error('password') is-invalid @enderror" placeholder="Minimal 6 karakter"
                        required autocomplete="new-password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" class="form-control"
                        placeholder="Ulangi kata sandi" required autocomplete="new-password">
                </div>

                <button type="submit" class="btn btn-simalab w-100">Buat Akun</button>
            </form>

            <div class="mt-4 pt-3 border-top text-center small">
                <span class="text-secondary">Sudah punya akun?</span>
                <a href="{{ route('login') }}" class="link-simalab ms-1">Masuk</a>
            </div>
        </div>
    </div>
@endsection