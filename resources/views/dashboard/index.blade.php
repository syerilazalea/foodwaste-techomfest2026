@extends('dashboard.layouts.app')

@push('styles')

<style>
    .card-img-horizontal {
        width: 100%;
        height: 100%;
        max-height: 80px;
        /* Anda boleh sesuaikan tingginya */
        object-fit: cover;
        border-radius: 6px;
    }

    .modal-img-fix {
        width: 100%;
        max-height: 300px;
        /* batas tinggi gambar dalam modal */
        object-fit: cover;
        border-radius: 10px;
    }

    .dynamic-font {
        white-space: nowrap;
        /* Jangan wrap */
        overflow: hidden;
        /* Sembunyikan kelebihan */
        text-overflow: ellipsis;
        /* Tampilkan "..." jika terpotong */
        font-size: clamp(12px, 2vw, 16px);
        /* Font otomatis mengecil jika terlalu panjang */
    }
</style>

@endpush

@section('content')

@php
$currentUser = Auth::user();
@endphp

<main>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title-container">
                    <h1 class="mb-0 pb-0 display-4" id="title">Selamat Datang, {{ $user->name }}!</h1>
                </div>
            </div>
        </div>

        <div class="row">
            <h2 class="small-title">Status Informasi Dipesan</h2>
            <div class="mb-5">
                <div class="row g-2">
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="card hover-scale-up cursor-pointer sh-19">
                            <div class="h-100 d-flex flex-column justify-content-between card-body align-items-center">
                                <div class="bg-gradient-light sh-5 sw-5 rounded-xl d-flex justify-content-center align-items-center mb-2">
                                    <i data-acorn-icon="loaf" class="text-white"></i>
                                </div>
                                <div class="heading text-center mb-0 d-flex align-items-center lh-1">Diterima</div>
                                <div class="text-small text-primary">14 PRODUCTS</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="card hover-scale-up cursor-pointer sh-19">
                            <div class="h-100 d-flex flex-column justify-content-between card-body align-items-center">
                                <div class="bg-gradient-light sh-5 sw-5 rounded-xl d-flex justify-content-center align-items-center mb-2">
                                    <i data-acorn-icon="clock" class="text-white"></i>
                                </div>
                                <div class="heading text-center mb-0 d-flex align-items-center lh-1">Menunggu Diambil
                                </div>
                                <div class="text-small text-primary">8 ITEM</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="card hover-scale-up cursor-pointer sh-19">
                            <div class="h-100 d-flex flex-column justify-content-between card-body align-items-center">
                                <div class="bg-gradient-light sh-5 sw-5 rounded-xl d-flex justify-content-center align-items-center mb-2">
                                    <i data-acorn-icon="leaf" class="text-white"></i>
                                </div>
                                <div class="heading text-center mb-0 d-flex align-items-center lh-1">Diterima</div>
                                <div class="text-small text-primary">21 PRODUCTS</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="card hover-scale-up cursor-pointer sh-19">
                            <div class="h-100 d-flex flex-column justify-content-between card-body align-items-center">
                                <div class="bg-gradient-light sh-5 sw-5 rounded-xl d-flex justify-content-center align-items-center mb-2">
                                    <i data-acorn-icon="send" class="text-white"></i>
                                </div>
                                <div class="heading text-center mb-0 d-flex align-items-center lh-1">Belum Diambil</div>
                                <div class="text-small text-primary">21 PRODUCTS</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Makanan -->
            <div class="col-12 col-xl-6 mb-5">
                <div class="d-flex justify-content-between">
                    <h2 class="small-title">Makanan</h2>
                    <button class="btn btn-icon btn-icon-only btn-sm btn-background-alternate mt-n2 shadow" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                        <i data-acorn-icon="more-horizontal" data-acorn-size="15"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end shadow">
                        <a class="dropdown-item" href="#">Semua</a>
                        <a class="dropdown-item" href="#">Belum Diambil</a>
                        <a class="dropdown-item" href="#">Sudah Diambil</a>
                    </div>
                </div>
                <div class="scroll-out">
                    <div class="scroll-by-count" data-count="4">
                        @foreach ($pesananMakanan as $item)
                        <div class="card mb-2">
                            <div class="row g-0 sh-12">
                                <div class="col-auto">
                                    <span
                                        class="badge rounded-pill
                                            @if($item->status == 'diterima')
                                                bg-primary
                                            @elseif($item->status == 'perjalanan')
                                                bg-info
                                            @elseif($item->status == 'menunggu')
                                                bg-warning
                                            @endif
                                                me-1 position-absolute s-n2 t-2 z-index-1 t-1">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                    <img src="{{ asset($item->makanan->gambar) }}" alt="{{ $item->nama}}" class="card-img card-img-horizontal sw-13 sw-lg-15" />
                                </div>
                                <div class="col">
                                    <div class="card-body pt-0 pb-0 h-100">
                                        <div class="row g-0 h-100 align-content-center">
                                            <div class="col-12 col-md-7 d-flex flex-column mb-2 mb-md-0">
                                                <span class="fw-bold">{{ $item->makanan->nama }}</span>
                                                <div class="text-small text-primary">
                                                    Batas Pengambilan: {{ \Carbon\Carbon::parse($item->makanan->batas_waktu)->format('H:i') }} WIB
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-5 d-flex align-items-center justify-content-md-end">
                                                <button class="btn btn-sm btn-outline-primary ms-1" data-bs-toggle="modal" data-bs-target="#detailModalMakanan{{ $item->id }}">
                                                    Detail
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Produk Daur Ulang -->
            <div class="col-12 col-xl-6 mb-5">
                <div class="d-flex justify-content-between">
                    <h2 class="small-title">Produk Daur Ulang</h2>
                    <button class="btn btn-icon btn-icon-only btn-sm btn-background-alternate mt-n2 shadow" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                        <i data-acorn-icon="more-horizontal" data-acorn-size="15"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end shadow">
                        <a class="dropdown-item" href="#">Semua</a>
                        <a class="dropdown-item" href="#">Belum Diambil</a>
                        <a class="dropdown-item" href="#">Sudah Diambil</a>
                    </div>
                </div>
                <div class="scroll-out">
                    <div class="scroll-by-count" data-count="4">
                        @foreach ($pesananDaurUlang as $item)
                        <div class="card mb-2">
                            <div class="row g-0 sh-12">
                                <div class="col-auto">
                                    <span
                                        class="badge rounded-pill
                                            @if($item->status == 'diterima')
                                                bg-primary
                                            @elseif($item->status == 'perjalanan')
                                                bg-info
                                            @elseif($item->status == 'menunggu')
                                                bg-warning
                                            @endif
                                                me-1 position-absolute s-n2 t-2 z-index-1 t-1">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                    <img src="{{ asset($item->daurUlang->gambar) }}" alt="{{ $item->nama }}" class="card-img card-img-horizontal sw-13 sw-lg-15" />
                                </div>
                                <div class="col">
                                    <div class="card-body pt-0 pb-0 h-100">
                                        <div class="row g-0 h-100 align-content-center">
                                            <div class="col-12 col-md-7 d-flex flex-column mb-2 mb-md-0">
                                                <span class="fw-bold">{{ $item->daurUlang->nama }}</span>
                                                <div class="text-small text-primary">
                                                    Batas Pengambilan: {{ \Carbon\Carbon::parse($item->daurUlang->batas_waktu)->format('H:i') }} WIB
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-5 d-flex align-items-center justify-content-md-end">
                                                <button class="btn btn-sm btn-outline-primary ms-1" data-bs-toggle="modal" data-bs-target="#detailModalDaurUlang{{ $item->id }}">
                                                    Detail
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <h2 class="small-title">Status Informasi Pemesanan</h2>
            <div class="mb-5">
                <div class="row g-2">
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="card hover-scale-up cursor-pointer sh-19">
                            <div class="h-100 d-flex flex-column justify-content-between card-body align-items-center">
                                <div class="bg-gradient-light sh-5 sw-5 rounded-xl d-flex justify-content-center align-items-center mb-2">
                                    <i data-acorn-icon="gift" class="text-white"></i>
                                </div>
                                <div class="heading text-center mb-0 d-flex align-items-center lh-1">
                                    Disumbangkan</div>
                                <div class="text-small text-primary">14 ITEM</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="card hover-scale-up cursor-pointer sh-19">
                            <div class="h-100 d-flex flex-column justify-content-between card-body align-items-center">
                                <div class="bg-gradient-light sh-5 sw-5 rounded-xl d-flex justify-content-center align-items-center mb-2">
                                    <i data-acorn-icon="send" class="text-white"></i>
                                </div>
                                <div class="heading text-center mb-0 d-flex align-items-center lh-1">Belum Diambil</div>
                                <div class="text-small text-primary">8 PRODUCTS</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="card hover-scale-up cursor-pointer sh-19">
                            <div class="h-100 d-flex flex-column justify-content-between card-body align-items-center">
                                <div class="bg-gradient-light sh-5 sw-5 rounded-xl d-flex justify-content-center align-items-center mb-2">
                                    <i data-acorn-icon="check-circle" class="text-white"></i>
                                </div>
                                <div class="heading text-center mb-0 d-flex align-items-center lh-1">Telah Diterima
                                </div>
                                <div class="text-small text-primary">21 ITEM</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="card hover-scale-up cursor-pointer sh-19">
                            <div class="h-100 d-flex flex-column justify-content-between card-body align-items-center">
                                <div class="bg-gradient-light sh-5 sw-5 rounded-xl d-flex justify-content-center align-items-center mb-2">
                                    <i data-acorn-icon="slash" class="text-white"></i>
                                </div>
                                <div class="heading text-center mb-0 d-flex align-items-center lh-1">Expired
                                </div>
                                <div class="text-small text-primary">21 ITEM</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Makanan yang dipesan -->
            <div class="col-12 col-xl-6 mb-5">
                <div class="d-flex justify-content-between">
                    <h2 class="small-title">Makanan</h2>
                    <button class="btn btn-icon btn-icon-only btn-sm btn-background-alternate mt-n2 shadow" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                        <i data-acorn-icon="more-horizontal" data-acorn-size="15"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end shadow">
                        <a class="dropdown-item" href="#">Semua</a>
                        <a class="dropdown-item" href="#">Belum Diambil</a>
                        <a class="dropdown-item" href="#">Sudah Diambil</a>
                    </div>
                </div>

                <div class="scroll-out">
                    <div class="scroll-by-count" data-count="4">
                        @foreach($dipesanMakanan as $item) @if($item->makanan)
                        <div class="card mb-2">
                            <div class="row g-0 sh-12">
                                <div class="col-auto position-relative">
                                    <span class="badge rounded-pill
                                @if($item->status == 'diterima') bg-primary
                                @elseif($item->status == 'perjalanan') bg-info
                                @elseif($item->status == 'menunggu') bg-warning
                                @endif
                                me-1 position-absolute s-n2 t-2 z-index-1 t-1">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                    <img src="{{ asset($item->makanan->gambar ?? 'default.png') }}" alt="{{ $item->makanan->nama ?? '-' }}" class="card-img card-img-horizontal sw-13 sw-lg-15" />
                                </div>

                                <div class="col">
                                    <div class="card-body pt-0 pb-0 h-100">
                                        <div class="row g-0 h-100 align-content-center">
                                            <div class="col-12 col-md-7 d-flex flex-column mb-2 mb-md-0">
                                                <span class="fw-bold">{{ $item->makanan->nama ?? '-' }}</span>
                                                <div class="text-muted small">
                                                    penyedia - @if ($item->makanan->user && $item->makanan->user->role === 'aktivis') {{ $item->makanan->user->organisasi }} @elseif($item->makanan->user) {{ $item->makanan->user->name }} @else - @endif
                                                </div>
                                                <div class="text-small text-primary">
                                                    Batas Pengambilan: {{ $item->makanan->batas_waktu ? \Carbon\Carbon::parse($item->makanan->batas_waktu)->format('H:i') : '-' }} WIB
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-5 d-flex align-items-center justify-content-md-end">
                                                <button class="btn btn-sm btn-outline-primary ms-1" data-bs-toggle="modal" data-bs-target="#modalMakanan{{ $item->id }}">
                                                    Detail
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        @endif @endforeach
                    </div>
                </div>
            </div>

            <!-- Produk Daur Ulang yang dipesan -->
            <div class="col-12 col-xl-6 mb-5">
                <div class="d-flex justify-content-between">
                    <h2 class="small-title">Makanan</h2>
                    <button class="btn btn-icon btn-icon-only btn-sm btn-background-alternate mt-n2 shadow" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                        <i data-acorn-icon="more-horizontal" data-acorn-size="15"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end shadow">
                        <a class="dropdown-item" href="#">Semua</a>
                        <a class="dropdown-item" href="#">Belum Diambil</a>
                        <a class="dropdown-item" href="#">Sudah Diambil</a>
                    </div>
                </div>

                <div class="scroll-out">
                    <div class="scroll-by-count" data-count="4">
                        @foreach($dipesanDaurUlang as $item) @if($item->daurUlang)
                        <div class="card mb-2">
                            <div class="row g-0 sh-12">
                                <div class="col-auto position-relative">
                                    <span class="badge rounded-pill
                                @if($item->status == 'diterima') bg-primary
                                @elseif($item->status == 'perjalanan') bg-info
                                @elseif($item->status == 'menunggu') bg-warning
                                @endif
                                me-1 position-absolute s-n2 t-2 z-index-1 t-1">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                    <img src="{{ asset($item->daurUlang->gambar ?? 'default.png') }}" alt="{{ $item->daurUlang->nama ?? '-' }}" class="card-img card-img-horizontal sw-13 sw-lg-15" />
                                </div>

                                <div class="col">
                                    <div class="card-body pt-0 pb-0 h-100">
                                        <div class="row g-0 h-100 align-content-center">
                                            <div class="col-12 col-md-7 d-flex flex-column mb-2 mb-md-0">
                                                <span class="fw-bold">{{ $item->daurUlang->nama ?? '-' }}</span>
                                                <div class="text-muted small">
                                                    penyedia - @if ($item->daurUlang->user && $item->daurUlang->user->role === 'aktivis') {{ $item->daurUlang->user->organisasi }} @elseif($item->daurUlang->user) {{ $item->daurUlang->user->name }} @else - @endif
                                                </div>
                                                <div class="text-small text-primary">
                                                    Batas Pengambilan: {{ $item->daurUlang->batas_waktu ? \Carbon\Carbon::parse($item->daurUlang->batas_waktu)->format('H:i') : '-' }} WIB
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-5 d-flex align-items-center justify-content-md-end">
                                                <button class="btn btn-sm btn-outline-primary ms-1" data-bs-toggle="modal" data-bs-target="#modalDaurUlang{{ $item->id }}">
                                                    Detail
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        @endif @endforeach
                    </div>
                </div>
            </div>

        </div>
</main>

<!-- modal 1 -->
@foreach($pesananMakanan as $item)
<div class="modal fade modal-close-out" id="detailModalMakanan{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg">

            <!-- GAMBAR & BADGE STATUS -->
            <div class="position-relative">
                <img src="{{ asset($item->makanan->gambar) }}"
                    class="img-fluid rounded modal-img-fix" />

                <span class="badge 
                    @if($item->status == 'diterima') bg-primary 
                    @elseif($item->status == 'perjalanan') bg-info
                    @elseif($item->status == 'menunggu') bg-warning 
                    @endif
                    text-white position-absolute"
                    style="top:12px; left:12px;">
                    {{ ucfirst($item->status) }}
                </span>
            </div>

            <!-- BODY -->
            <div class="modal-body">
                <h5 class="fw-bold mb-3">{{ $item->makanan->nama }}</h5>

                <div class="container px-0">

                    <!-- PENYEDIA & KONTAK -->
                    <div class="row mb-3">
                        <div class="col-6 d-flex">
                            <i data-acorn-icon="user" class="me-2 text-primary"></i>
                            <div>
                                <div class="text-muted small text-truncate dynamic-font" style="max-width: 200px;">
                                    penyedia
                                </div>
                                <div class="fw-semibold">@if ($item->makanan->user->role === 'aktivis')
                                    {{ $item->makanan->user->organisasi }}
                                    @else
                                    {{ $item->makanan->user->name }}
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-6 d-flex">
                            <i data-acorn-icon="phone" class="me-2 text-primary"></i>
                            <div>
                                <div class="text-muted small">Kontak</div>
                                <div class="fw-semibold">{{ $item->user->phone}}</div>
                            </div>
                        </div>
                    </div>

                    <!-- BATAS & STATUS -->
                    <div class="row mb-3">
                        <div class="col-6 d-flex">
                            <i data-acorn-icon="clock" class="me-2 text-primary"></i>
                            <div>
                                <div class="text-muted small">Batas Pengambilan</div>
                                <div class="fw-semibold text-secondary">
                                    {{ \Carbon\Carbon::parse($item->makanan->batas_waktu)->format('H:i') }} WIB
                                </div>
                            </div>
                        </div>
                        <div class="col-6 d-flex">
                            <i data-acorn-icon="check-square" class="me-2 text-primary"></i>
                            <div>
                                <div class="text-muted small">Status</div>
                                <span class="badge 
                                            @if($item->status == 'diterima')
                                                bg-primary
                                            @elseif($item->status == 'perjalanan')
                                                bg-info
                                            @elseif($item->status == 'menunggu')
                                                bg-warning
                                            @endif
                                ">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- ALAMAT -->
                    <div class="mb-1 d-flex align-items-center">
                        <i data-acorn-icon="pin" class="me-2 text-primary"></i>
                        <span class="text-muted small">Alamat</span>
                    </div>

                    <div class="ms-4 mb-2">
                        {{ $item->makanan->user->alamat }}<br>
                        @php
                        $openMapUrl = "https://www.google.com/maps/search/?api=1&query=" . urlencode($item->makanan->user->alamat);
                        @endphp

                        <a href="{{ $openMapUrl }}" target="_blank" class="text-primary text-small">
                            Buka di Google Maps
                        </a>
                    </div>
                    <!-- IFRAME GOOGLE MAPS -->
                    @if($item->makanan->user->iframe_maps)
                    <div class="ms-4 mb-3">
                        <iframe
                            src="{{ $item->makanan->user->iframe_maps }}"
                            class="img-fluid rounded shadow-sm"
                            style="width: 100%; height: 160px; object-fit: cover; border:0;"
                            allowfullscreen=""
                            loading="lazy">
                        </iframe>
                    </div>
                    @endif
                </div>
            </div>

            <!-- FOOTER: TOMBOL -->
            <div class="p-3 border-top bg-white">
                <div class="d-grid gap-2 mb-3">
                    @if($item->status == 'sudah diambil')
                    <button class="btn btn-success" disabled>Sudah Diambil</button>

                    @elseif($item->status == 'diterima')
                    <button class="btn btn-primary" disabled>Diterima</button>

                    @elseif($item->status == 'menunggu')
                    @if(Auth::id() === $item->user_id || Auth::id() === $item->makanan->user_id)
                    <!-- Hanya user pemesan atau penyedia yang bisa menekan -->
                    <form action="{{ route('dashboard.pengambilanMakanan.mulai', $item->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-warning w-100" type="submit">Ingin Mengambil</button>
                    </form>
                    @else
                    <button class="btn btn-warning w-100" disabled>Menunggu</button>
                    @endif

                    @elseif($item->status == 'perjalanan')
                    <button class="btn btn-info" disabled>Perjalanan</button>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
@endforeach

<!-- modal 2 -->
@foreach($pesananDaurUlang as $item)
<div class="modal fade modal-close-out" id="detailModalDaurUlang{{ $item->id }}" tabindex="-1" aria-labelledby="detailMarketplaceLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="position-relative">
                <img src="{{ asset($item->daurUlang->gambar) }}" class="img-fluid rounded modal-img-fix" alt="Responsive image" />
                <span class="badge 
                    @if($item->status == 'diterima') bg-primary 
                    @elseif($item->status == 'perjalanan') bg-info
                    @elseif($item->status == 'menunggu') bg-warning 
                    @endif
                    text-white position-absolute"
                    style="top:12px; left:12px;">
                    {{ ucfirst($item->status) }}
                </span>
            </div>
            <div class="modal-body">
                <h5 class="fw-bold mb-3">{{ $item->nama }}</h5>
                <div class="container px-0">
                    <div class="row mb-3">
                        <div class="col-6 d-flex">
                            <i data-acorn-icon="user" class="me-2 text-primary"></i>
                            <div>
                                <div class="text-muted small text-truncate dynamic-font" style="max-width: 200px;">
                                    penyedia
                                </div>
                                <div class="fw-semibold">@if ($item->user->role === 'aktivis')
                                    {{ $item->user->organisasi }}
                                    @else
                                    {{ $item->user->name }}
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-6 d-flex">
                            <i data-acorn-icon="phone" class="me-2 text-primary"></i>
                            <div>
                                <div class="text-muted small">Kontak</div>
                                <div class="fw-semibold">{{ $item->user->phone}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6 d-flex">
                            <i data-acorn-icon="clock" class="me-2 text-primary"></i>
                            <div>
                                <div class="text-muted small">Batas Pengambilan</div>
                                <div class="fw-semibold text-danger">{{ \Carbon\Carbon::parse($item->batas_waktu)->format('H:i') }} WIB</div>
                            </div>
                        </div>
                        <div class="col-6 d-flex">
                            <i data-acorn-icon="check-square" class="me-2 text-primary"></i>
                            <div>
                                <div class="text-muted small">Status</div>
                                <span class="badge 
                                            @if($item->status == 'diterima')
                                                bg-primary
                                            @elseif($item->status == 'perjalanan')
                                                bg-info
                                            @elseif($item->status == 'menunggu')
                                                bg-warning
                                            @endif
                                ">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-1 d-flex align-items-center">
                        <i data-acorn-icon="pin" class="me-2 text-primary"></i>
                        <span class="text-muted small">Alamat</span>
                    </div>
                    <div class="ms-4 mb-2">
                        {{ $item->user->alamat }}<br>
                        @php
                        $openMapUrl = "https://www.google.com/maps/search/?api=1&query=" . urlencode($item->user->alamat);
                        @endphp

                        <a href="{{ $openMapUrl }}" target="_blank" class="text-primary text-small">
                            Buka di Google Maps
                        </a>
                    </div>
                    <!-- IFRAME GOOGLE MAPS -->
                    @if($item->user->iframe_maps)
                    <div class="ms-4 mb-3">
                        <iframe
                            src="{{ $item->daurUlang->user->iframe_maps }}"
                            class="img-fluid rounded shadow-sm"
                            style="width: 100%; height: 160px; object-fit: cover; border:0;"
                            allowfullscreen=""
                            loading="lazy">
                        </iframe>
                    </div>
                    @endif
                </div>
            </div>

            <!-- FOOTER: TOMBOL -->
            <div class="p-3 border-top bg-white">
                <div class="d-grid gap-2 mb-3">
                    @if($item->status == 'sudah diambil')
                    <button class="btn btn-success" disabled>Sudah Diambil</button>

                    @elseif($item->status == 'diterima')
                    <button class="btn btn-primary" disabled>Diterima</button>

                    @elseif($item->status == 'menunggu')
                    @if(Auth::id() === $item->user_id || Auth::id() === $item->daurUlang->user_id)
                    <!-- Hanya user pemesan atau penyedia yang bisa menekan -->
                    <form action="{{ route('dashboard.pengambilanDaurUlang.mulai', $item->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-warning w-100" type="submit">Ingin Mengambil</button>
                    </form>
                    @else
                    <button class="btn btn-warning w-100" disabled>Menunggu</button>
                    @endif

                    @elseif($item->status == 'perjalanan')
                    <button class="btn btn-info" disabled>Perjalanan</button>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
@endforeach

<!-- MODAL MAKANAN -->
@foreach($dipesanMakanan as $item)
@if(Auth::id() === $item->makanan?->user_id)
<div class="modal fade modal-close-out" id="modalMakanan{{ $item->id }}" tabindex="-1" aria-labelledby="modalMakananLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg">

            <!-- IMAGE -->
            <div class="position-relative">
                <img src="{{ asset($item->makanan->gambar) }}" class="img-fluid rounded modal-img-fix" alt="{{ $item->makanan->nama }}" />
                <span class="badge
                    @if($item->status == 'diterima') bg-primary
                    @elseif($item->status == 'perjalanan') bg-info
                    @elseif($item->status == 'menunggu') bg-warning text-dark @endif
                    position-absolute" style="top: 12px; left: 12px;">
                    {{ ucfirst($item->status) }}
                </span>
            </div>

            <div class="modal-body">
                <h5 class="fw-bold mb-3">{{ $item->makanan->nama }}</h5>
                <div class="container px-0">
                    <div class="row mb-3">
                        <div class="col-6 d-flex">
                            <i data-acorn-icon="building-large" class="me-2 text-primary"></i>
                            <div>
                                <div class="text-muted small">Penyedia</div>
                                <div class="d-flex align-items-center gap-1">
                                    <div class="fw-semibold text-truncate dynamic-font" style="max-width: 200px;">
                                        @if($item->makanan->user->role === 'aktivis')
                                        {{ $item->makanan->user->organisasi }}
                                        @else
                                        {{ $item->makanan->user->name }}
                                        @endif
                                    </div>
                                    <span class="text-muted small">•</span>
                                    <div class="text-muted small">{{ ucfirst($item->makanan->kategori) }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 d-flex">
                            <i data-acorn-icon="grid-1" class="me-2 text-primary"></i>
                            <div>
                                <div class="text-muted small">Jumlah Porsi</div>
                                <div class="fw-semibold">{{ $item->jumlah }} Porsi</div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-6 d-flex">
                            <i data-acorn-icon="clock" class="me-2 text-primary"></i>
                            <div>
                                <div class="text-muted small">Batas Pengambilan</div>
                                <div class="fw-semibold text-danger">{{ \Carbon\Carbon::parse($item->makanan->batas_waktu)->format('H:i') }} WIB</div>
                            </div>
                        </div>
                        <div class="col-6 d-flex">
                            <i data-acorn-icon="phone" class="me-2 text-primary"></i>
                            <div>
                                <div class="text-muted small">Kontak</div>
                                <div class="fw-semibold">{{ $item->user->phone ?? '-' }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- ALAMAT -->
                    <div class="mb-1 d-flex align-items-center">
                        <i data-acorn-icon="pin" class="me-2 text-primary"></i>
                        <span class="text-muted small">Alamat</span>
                    </div>
                    <div class="ms-4 mb-2">
                        {{ $item->makanan->user->alamat }}<br>
                        @php
                        $openMapUrl = "https://www.google.com/maps/search/?api=1&query=" . urlencode($item->makanan->user->alamat);
                        @endphp

                        <a href="{{ $openMapUrl }}" target="_blank" class="text-primary text-small">
                            Buka di Google Maps
                        </a>
                    </div>
                    @if($item->makanan->user->iframe_maps)
                    <div class="ms-4 mb-3">
                        <iframe
                            src="{{ $item->makanan->user->iframe_maps }}"
                            class="img-fluid rounded shadow-sm"
                            style="width: 100%; height: 160px; object-fit: cover; border:0;"
                            allowfullscreen=""
                            loading="lazy">
                        </iframe>
                    </div>
                    @endif
                    <!-- PENERIMA -->
                    <div class="border rounded p-3 bg-light mb-3">
                        <h6 class="fw-bold mb-2">Informasi Penerima</h6>
                        <div class="row mb-3">
                            <div class="col-6 d-flex">
                                <i data-acorn-icon="user" class="me-2 text-primary"></i>
                                <div>
                                    <div class="text-muted small">Nama Penerima</div>
                                    <div class="fw-semibold">{{ $item->user->name }}</div>
                                </div>
                            </div>
                            <div class="col-6 d-flex">
                                <i data-acorn-icon="phone" class="me-2 text-primary"></i>
                                <div>
                                    <div class="text-muted small">Nomor Telepon</div>
                                    <div class="fw-semibold">{{ $item->user->phone ?? '-' }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6 d-flex">
                                <i data-acorn-icon="archive" class="me-2 text-primary"></i>
                                <div>
                                    <div class="text-muted small">Jumlah Diambil</div>
                                    <div class="fw-semibold">{{ $item->jumlah }} Porsi</div>
                                </div>
                            </div>
                            <div class="col-6 d-flex">
                                <i data-acorn-icon="clock" class="me-2 text-primary"></i>
                                <div>
                                    <div class="text-muted small">Batas Waktu Pengambilan</div>
                                    <div class="fw-semibold text-danger">{{ \Carbon\Carbon::parse($item->makanan->batas_waktu)->format('H:i') }} WIB</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- BUTTON -->
            <div class="p-3 border-top bg-white">
                <button class="btn btn-success w-100" data-bs-dismiss="modal">Konfirmasi Sudah Diambil</button>
            </div>
        </div>
    </div>
</div>
@endif
@endforeach

<!-- MODAL DAUR ULANG -->
@foreach($dipesanDaurUlang as $item)
@if(Auth::id() === $item->daurUlang?->user_id)
<div class="modal fade modal-close-out" id="modalDaurUlang{{ $item->id }}" tabindex="-1" aria-labelledby="modalDaurUlangLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg">

            <!-- IMAGE -->
            <div class="position-relative">
                <img src="{{ asset($item->daurUlang->gambar) }}" class="img-fluid rounded modal-img-fix" alt="{{ $item->daurUlang->nama }}" />
                <span class="badge
                    @if($item->status == 'diterima') bg-primary
                    @elseif($item->status == 'perjalanan') bg-info
                    @elseif($item->status == 'menunggu') bg-warning text-dark @endif
                    position-absolute" style="top: 12px; left: 12px;">
                    {{ ucfirst($item->status) }}
                </span>
            </div>

            <div class="modal-body">
                <h5 class="fw-bold mb-3">{{ $item->daurUlang->nama }}</h5>
                <div class="container px-0">
                    <div class="row mb-3">
                        <div class="col-6 d-flex">
                            <i data-acorn-icon="building-large" class="me-2 text-primary"></i>
                            <div>
                                <div class="text-muted small">Penyedia</div>
                                <div class="d-flex align-items-center gap-1">
                                    <div class="fw-semibold text-truncate dynamic-font" style="max-width: 200px;">
                                        @if($item->daurUlang->user->role === 'aktivis')
                                        {{ $item->daurUlang->user->organisasi }}
                                        @else
                                        {{ $item->daurUlang->user->name }}
                                        @endif
                                    </div>
                                    <span class="text-muted small">•</span>
                                    <div class="text-muted small">{{ ucfirst($item->daurUlang->kategori) }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 d-flex">
                            <i data-acorn-icon="grid-1" class="me-2 text-primary"></i>
                            <div>
                                <div class="text-muted small">Berat</div>
                                <div class="fw-semibold">{{ $item->jumlah }} kg</div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-6 d-flex">
                            <i data-acorn-icon="clock" class="me-2 text-primary"></i>
                            <div>
                                <div class="text-muted small">Batas Pengambilan</div>
                                <div class="fw-semibold text-danger">{{ \Carbon\Carbon::parse($item->daurUlang->batas_waktu)->format('H:i') }} WIB</div>
                            </div>
                        </div>
                        <div class="col-6 d-flex">
                            <i data-acorn-icon="phone" class="me-2 text-primary"></i>
                            <div>
                                <div class="text-muted small">Kontak</div>
                                <div class="fw-semibold">{{ $item->user->phone ?? '-' }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- ALAMAT -->
                    <div class="mb-1 d-flex align-items-center">
                        <i data-acorn-icon="pin" class="me-2 text-primary"></i>
                        <span class="text-muted small">Alamat</span>
                    </div>
                    <div class="ms-4 mb-2">
                        {{ $item->daurUlang->user->alamat }}<br>
                        @php
                        $openMapUrl = "https://www.google.com/maps/search/?api=1&query=" . urlencode($item->daurUlang->user->alamat);
                        @endphp

                        <a href="{{ $openMapUrl }}" target="_blank" class="text-primary text-small">
                            Buka di Google Maps
                        </a>
                    </div>
                    @if($item->daurUlang->user->iframe_maps)
                    <div class="ms-4 mb-3">
                        <iframe
                            src="{{ $item->daurUlang->user->iframe_maps }}"
                            class="img-fluid rounded shadow-sm"
                            style="width: 100%; height: 160px; object-fit: cover; border:0;"
                            allowfullscreen=""
                            loading="lazy">
                        </iframe>
                    </div>
                    @endif
                    <!-- PENERIMA -->
                    <div class="border rounded p-3 bg-light mb-3">
                        <h6 class="fw-bold mb-2">Informasi Penerima</h6>
                        <div class="row mb-3">
                            <div class="col-6 d-flex">
                                <i data-acorn-icon="user" class="me-2 text-primary"></i>
                                <div>
                                    <div class="text-muted small">Nama Penerima</div>
                                    <div class="fw-semibold">{{ $item->user->name }}</div>
                                </div>
                            </div>
                            <div class="col-6 d-flex">
                                <i data-acorn-icon="phone" class="me-2 text-primary"></i>
                                <div>
                                    <div class="text-muted small">Nomor Telepon</div>
                                    <div class="fw-semibold">{{ $item->user->phone ?? '-' }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6 d-flex">
                                <i data-acorn-icon="archive" class="me-2 text-primary"></i>
                                <div>
                                    <div class="text-muted small">Jumlah Diambil</div>
                                    <div class="fw-semibold">{{ $item->jumlah }} Porsi</div>
                                </div>
                            </div>
                            <div class="col-6 d-flex">
                                <i data-acorn-icon="clock" class="me-2 text-primary"></i>
                                <div>
                                    <div class="text-muted small">Batas Waktu Pengambilan</div>
                                    <div class="fw-semibold text-danger">{{ \Carbon\Carbon::parse($item->daurUlang->batas_waktu)->format('H:i') }} WIB</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- BUTTON -->
            <div class="p-3 border-top bg-white">
                <button class="btn btn-success w-100" data-bs-dismiss="modal">Konfirmasi Sudah Diambil</button>
            </div>
        </div>
    </div>
</div>
@endif
@endforeach
@endsection