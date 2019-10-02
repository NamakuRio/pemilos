@extends('templates.master')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/dashforge.auth.css') }}">
@endpush

@section('content')
<div class="content content-fixed content-auth">
    <div class="container">
        <div class="media align-items-stretch justify-content-center ht-100p pos-relative">
            <div class="media-body align-items-center d-none d-lg-flex">
                <div class="mx-wd-600">
                    <img src="{{ asset('assets/img/img15.png') }}" class="img-fluid" alt="">
                </div>
            </div>

            <div class="sign-wrapper mg-lg-l-50 mg-xl-l-60">
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="wd-100p">
                        <h3 class="tx-color-01 mg-b-5">Masuk</h3>
                        <p class="tx-color-03 tx-16 mg-b-40">Selamat datang! Silakan masuk untuk melanjutkan.</p>

                        <div class="form-group">
                            <label>Nama Pengguna</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" placeholder="Nama Pengguna" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="d-flex justify-content-between mg-b-5">
                                <label class="mg-b-0-f">Kata Sandi</label>
                            </div>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Kata Sandi" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button class="btn btn-brand-02 btn-block">Masuk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
