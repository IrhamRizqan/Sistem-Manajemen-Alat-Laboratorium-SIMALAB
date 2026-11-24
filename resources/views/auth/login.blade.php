@extends('layouts.guest')

@section('title', 'Masuk')

@section('content')
    <div class="card card-simalab shadow-sm">
        <div class="card-body p-4">
            <h1 class="h4 fw-bold mb-1">Masuk Petugas</h1>
            <p class="text-secondary small mb-4">Gunakan akun petugas laboratorium</p>

            @if ($errors->any())
                <div class="alert alert-danger" role="alert">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}" novalidate>
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                        class="form-control @error('email') is-invalid @enderror" placeholder="nama@simalab.test" required
                        autofocus autocomplete="email">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <input id="password" type="password" name="password"
                        class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan kata sandi"
                        required autocomplete="current-password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-simalab w-100">Masuk</button>
            </form>

            <div class="mt-4 pt-3 border-top text-center small">
                <span class="text-secondary">Belum punya akun?</span>
                <a href="{{ route('register') }}" class="link-simalab ms-1">Daftar petugas</a>
            </div>
        </div>
    </div>
@endsection