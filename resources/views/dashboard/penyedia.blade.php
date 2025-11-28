@extends('dashboard.layouts.app')

@section('content')

<main>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title-container">
                    <h1 class="mb-0 pb-0 display-4" id="title">Selamat Datang, Penyedia!</h1>
                </div>
            </div>
        </div>

        <div class="row">
            <h2 class="small-title">Status Informasi</h2>
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
                        <div class="card mb-2">
                            <div class="row g-0 sh-12">
                                <div class="col-auto">
                                    <span class="badge rounded-pill bg-primary me-1 position-absolute s-n2 t-2 z-index-1 t-1">Diterima</span>
                                    <img src="{{asset ('img/product/small/product-1.webp')}}" alt="Foto" class="card-img card-img-horizontal sw-13 sw-lg-15" />
                                </div>
                                <div class="col">
                                    <div class="card-body pt-0 pb-0 h-100">
                                        <div class="row g-0 h-100 align-content-center">
                                            <div class="col-12 col-md-7 d-flex flex-column mb-2 mb-md-0">
                                                <span class="fw-bold">Kompost Sayur</span>
                                                <div class="text-small text-primary">
                                                    Diambil Pada: 14.00 WIB
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-5 d-flex align-items-center justify-content-md-end">
                                                <button class="btn btn-sm btn-outline-primary ms-1" data-bs-toggle="modal" data-bs-target="#modalMakanan">
                                                    Detail
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="card mb-2">
                            <div class="row g-0 sh-12">
                                <div class="col-auto">
                                    <span class="badge rounded-pill bg-primary me-1 position-absolute s-n2 t-2 z-index-1 t-1">Diterima</span>
                                    <img src="{{asset ('img/product/small/product-1.webp')}}" alt="Foto" class="card-img card-img-horizontal sw-13 sw-lg-15" />
                                </div>
                                <div class="col">
                                    <div class="card-body pt-0 pb-0 h-100">
                                        <div class="row g-0 h-100 align-content-center">
                                            <div class="col-12 col-md-7 d-flex flex-column mb-2 mb-md-0">
                                                <span class="fw-bold">Kompost Sayur</span>
                                                <div class="text-small text-primary">
                                                    Diambil Pada: 14.00 WIB
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-5 d-flex align-items-center justify-content-md-end">
                                                <button class="btn btn-sm btn-outline-primary ms-1" data-bs-toggle="modal" data-bs-target="#modalMakanan">
                                                    Detail
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-2">
                            <div class="row g-0 sh-12">
                                <div class="col-auto">
                                    <span class="badge rounded-pill bg-warning me-1 position-absolute s-n2 t-2 z-index-1 t-1">Diterima</span>
                                    <img src="{{asset ('img/product/small/product-1.webp')}}" alt="Foto" class="card-img card-img-horizontal sw-13 sw-lg-15" />
                                </div>
                                <div class="col">
                                    <div class="card-body pt-0 pb-0 h-100">
                                        <div class="row g-0 h-100 align-content-center">
                                            <div class="col-12 col-md-7 d-flex flex-column mb-2 mb-md-0">
                                                <span class="fw-bold">Kompost Sayur</span>
                                                <div class="text-small text-danger">
                                                    Batas Pengambilan: 14.00 WIB
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-5 d-flex align-items-center justify-content-md-end">
                                                <button class="btn btn-sm btn-outline-primary ms-1" data-bs-toggle="modal" data-bs-target="#modalMakanan">
                                                    Detail
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-2">
                            <div class="row g-0 sh-12">
                                <div class="col-auto">
                                    <span class="badge rounded-pill bg-warning me-1 position-absolute s-n2 t-2 z-index-1 t-1">Diterima</span>
                                    <img src="{{asset ('img/product/small/product-1.webp')}}" alt="Foto" class="card-img card-img-horizontal sw-13 sw-lg-15" />
                                </div>
                                <div class="col">
                                    <div class="card-body pt-0 pb-0 h-100">
                                        <div class="row g-0 h-100 align-content-center">
                                            <div class="col-12 col-md-7 d-flex flex-column mb-2 mb-md-0">
                                                <span class="fw-bold">Kompost Sayur</span>
                                                <div class="text-small text-danger">
                                                    Batas Pengambilan: 14.00 WIB
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-5 d-flex align-items-center justify-content-md-end">
                                                <button class="btn btn-sm btn-outline-primary ms-1" data-bs-toggle="modal" data-bs-target="#modalMakanan">
                                                    Detail
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-2">
                            <div class="row g-0 sh-12">
                                <div class="col-auto">
                                    <span class="badge rounded-pill  bg-warning me-1 position-absolute s-n2 t-2 z-index-1 t-1">Diterima</span>
                                    <img src="{{asset ('img/product/small/product-1.webp')}}" alt="Foto" class="card-img card-img-horizontal sw-13 sw-lg-15" />
                                </div>
                                <div class="col">
                                    <div class="card-body pt-0 pb-0 h-100">
                                        <div class="row g-0 h-100 align-content-center">
                                            <div class="col-12 col-md-7 d-flex flex-column mb-2 mb-md-0">
                                                <span class="fw-bold">Kompost Sayur</span>
                                                <div class="text-small text-danger">
                                                    Batas Pengambilan: 14.00 WIB
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-5 d-flex align-items-center justify-content-md-end">
                                                <button class="btn btn-sm btn-outline-primary ms-1" data-bs-toggle="modal" data-bs-target="#modalMakanan">
                                                    Detail
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
                        <div class="card mb-2">
                            <div class="row g-0 sh-12">
                                <div class="col-auto">
                                    <span class="badge rounded-pill bg-primary me-1 position-absolute s-n2 t-2 z-index-1 t-1">Diterima</span>
                                    <img src="{{asset ('img/product/small/product-1.webp')}}" alt="Foto" class="card-img card-img-horizontal sw-13 sw-lg-15" />
                                </div>
                                <div class="col">
                                    <div class="card-body pt-0 pb-0 h-100">
                                        <div class="row g-0 h-100 align-content-center">
                                            <div class="col-12 col-md-7 d-flex flex-column mb-2 mb-md-0">
                                                <span class="fw-bold">Kompost Sayur</span>
                                                <div class="text-small text-primary">
                                                    Diambil Pada: 14.00 WIB
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-5 d-flex align-items-center justify-content-md-end">
                                                <button class="btn btn-sm btn-outline-primary ms-1" data-bs-toggle="modal" data-bs-target="#modalDaurUlang">
                                                    Detail
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-2">
                            <div class="row g-0 sh-12">
                                <div class="col-auto">
                                    <span class="badge rounded-pill bg-primary me-1 position-absolute s-n2 t-2 z-index-1 t-1">Diterima</span>
                                    <img src="{{asset ('img/product/small/product-1.webp')}}" alt="Foto" class="card-img card-img-horizontal sw-13 sw-lg-15" />
                                </div>
                                <div class="col">
                                    <div class="card-body pt-0 pb-0 h-100">
                                        <div class="row g-0 h-100 align-content-center">
                                            <div class="col-12 col-md-7 d-flex flex-column mb-2 mb-md-0">
                                                <span class="fw-bold">Kompost Sayur</span>
                                                <div class="text-small text-primary">
                                                    Diambil Pada: 14.00 WIB
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-5 d-flex align-items-center justify-content-md-end">
                                                <button class="btn btn-sm btn-outline-primary ms-1" data-bs-toggle="modal" data-bs-target="#modalDaurUlang">
                                                    Detail
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-2">
                            <div class="row g-0 sh-12">
                                <div class="col-auto">
                                    <span class="badge rounded-pill bg-warning me-1 position-absolute s-n2 t-2 z-index-1 t-1">Diterima</span>
                                    <img src="{{asset ('img/product/small/product-1.webp')}}" alt="Foto" class="card-img card-img-horizontal sw-13 sw-lg-15" />
                                </div>
                                <div class="col">
                                    <div class="card-body pt-0 pb-0 h-100">
                                        <div class="row g-0 h-100 align-content-center">
                                            <div class="col-12 col-md-7 d-flex flex-column mb-2 mb-md-0">
                                                <span class="fw-bold">Kompost Sayur</span>
                                                <div class="text-small text-danger">
                                                    Batas Pengambilan: 14.00 WIB
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-5 d-flex align-items-center justify-content-md-end">
                                                <button class="btn btn-sm btn-outline-primary ms-1" data-bs-toggle="modal" data-bs-target="#modalDaurUlang">
                                                    Detail
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-2">
                            <div class="row g-0 sh-12">
                                <div class="col-auto">
                                    <span class="badge rounded-pill bg-warning me-1 position-absolute s-n2 t-2 z-index-1 t-1">Diterima</span>
                                    <img src="{{asset ('img/product/small/product-1.webp')}}" alt="Foto" class="card-img card-img-horizontal sw-13 sw-lg-15" />
                                </div>
                                <div class="col">
                                    <div class="card-body pt-0 pb-0 h-100">
                                        <div class="row g-0 h-100 align-content-center">
                                            <div class="col-12 col-md-7 d-flex flex-column mb-2 mb-md-0">
                                                <span class="fw-bold">Kompost Sayur</span>
                                                <div class="text-small text-danger">
                                                    Batas Pengambilan: 14.00 WIB
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-5 d-flex align-items-center justify-content-md-end">
                                                <button class="btn btn-sm btn-outline-primary ms-1" data-bs-toggle="modal" data-bs-target="#modalDaurUlang">
                                                    Detail
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-2">
                            <div class="row g-0 sh-12">
                                <div class="col-auto">
                                    <span class="badge rounded-pill bg-warning me-1 position-absolute s-n2 t-2 z-index-1 t-1">Diterima</span>
                                    <img src="{{asset ('img/product/small/product-1.webp')}}" alt="Foto" class="card-img card-img-horizontal sw-13 sw-lg-15" />
                                </div>
                                <div class="col">
                                    <div class="card-body pt-0 pb-0 h-100">
                                        <div class="row g-0 h-100 align-content-center">
                                            <div class="col-12 col-md-7 d-flex flex-column mb-2 mb-md-0">
                                                <span class="fw-bold">Kompost Sayur</span>
                                                <div class="text-small text-danger">
                                                    Batas Pengambilan: 14.00 WIB
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-5 d-flex align-items-center justify-content-md-end">
                                                <button class="btn btn-sm btn-outline-primary ms-1" data-bs-toggle="modal" data-bs-target="#modalDaurUlang">
                                                    Detail
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</main>

<!-- MODAL MAKANAN -->
<div class="modal fade modal-close-out" id="modalMakanan" tabindex="-1" aria-labelledby="modalMakananLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <!-- IMAGE -->
            <div class="position-relative">
                <div class="position-relative">
                    <img src="img/product/large/product-2.webp" class="img-fluid rounded" alt="Responsive image" />
                    <span class="badge bg-warning text-dark position-absolute" style="top: 12px; left: 12px;">
                        Belum Diambil
                    </span>
                </div>
            </div>
            <div class="modal-body">
                <h5 class="fw-bold mb-3">Nasi Kotak Ayam</h5>
                <div class="container px-0">
                    <div class="row mb-3">
                        <div class="col-6 d-flex">
                            <i data-acorn-icon="building-large" class="me-2 text-primary"></i>
                            <div>
                                <div class="text-muted small">Penyedia</div>
                                <div class="d-flex align-items-center gap-1">
                                    <div class="fw-semibold">RM Padang Pagi Sore</div>
                                    <span class="text-muted small">•</span>
                                    <div class="text-muted small">Restoran</div>
                                </div>

                            </div>
                        </div>
                        <div class="col-6 d-flex">
                            <i data-acorn-icon="grid-1" class="me-2 text-primary"></i>
                            <div>
                                <div class="text-muted small">Jumlah Porsi</div>
                                <div class="fw-semibold">35 Porsi</div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6 d-flex">
                            <i data-acorn-icon="clock" class="me-2 text-primary"></i>
                            <div>
                                <div class="text-muted small">Batas Pengambilan</div>
                                <div class="fw-semibold">14.30</div>

                            </div>
                        </div>
                        <div class="col-6 d-flex">
                            <i data-acorn-icon="phone" class="me-2 text-primary"></i>
                            <div>
                                <div class="text-muted small">Kontak</div>
                                <div class="fw-semibold">0813-4567-8899</div>
                            </div>
                        </div>
                    </div>

                    <!-- ALAMAT -->
                    <div class="mb-1 d-flex align-items-center">
                        <i data-acorn-icon="pin" class="me-2 text-primary"></i>
                        <span class="text-muted small">Alamat</span>
                    </div>
                    <div class="ms-4 mb-2">
                        Jl. Sudirman No. 45, Jakarta <br>
                        <a href="https://maps.google.com" target="_blank" class="text-primary text-small">
                            Buka di Google Maps
                        </a>
                    </div>
                    <div class="ms-4 mb-3">
                        <a href="https://maps.google.com" target="_blank">
                            <img src="img/maps-thumbnail.png" class="img-fluid rounded shadow-sm" style="width: 100%; max-height: 160px; object-fit: cover;" />
                        </a>
                    </div>

                    <!-- PENERIMA -->
                    <div class="border rounded p-3 bg-light mb-3">
                        <h6 class="fw-bold mb-2">Informasi Penerima</h6>
                        <div class="row mb-3">
                            <div class="col-6 d-flex">
                                <i data-acorn-icon="user" class="me-2 text-primary"></i>
                                <div>
                                    <div class="text-muted small">Nama Penerima</div>
                                    <div class="fw-semibold">Budi Santoso</div>
                                </div>
                            </div>
                            <div class="col-6 d-flex">
                                <i data-acorn-icon="phone" class="me-2 text-primary"></i>
                                <div>
                                    <div class="text-muted small">Nomor Telepon</div>
                                    <div class="fw-semibold">0812-9988-7766</div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6 d-flex">
                                <i data-acorn-icon="archive" class="me-2 text-primary"></i>
                                <div>
                                    <div class="text-muted small">Jumlah Diambil</div>
                                    <div class="fw-semibold">10 Porsi</div>
                                </div>
                            </div>
                            <div class="col-6 d-flex">
                                <i data-acorn-icon="clock" class="me-2 text-primary"></i>
                                <div>
                                    <div class="text-muted small">Batas Waktu Pengambilan</div>
                                    <div class="fw-semibold text-danger">14.30 WIB</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- BUTTON -->
            <div class="p-3 border-top bg-white">
                <button class="btn btn-success w-100" data-bs-dismiss>Konfirmasi Sudah Diambil</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL DAUR ULANG -->
<div class="modal fade modal-close-out" id="modalDaurUlang" tabindex="-1" aria-labelledby="modalMakananLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <!-- IMAGE -->
            <div class="position-relative">
                <div class="position-relative">
                    <img src="img/product/large/product-2.webp" class="img-fluid rounded" alt="Responsive image" />
                    <span class="badge bg-warning text-dark position-absolute" style="top: 12px; left: 12px;">
                        Belum Diambil
                    </span>
                </div>
            </div>
            <div class="modal-body">
                <h5 class="fw-bold mb-3">Sisa Bahan Masakan</h5>
                <div class="container px-0">
                    <div class="row mb-3">
                        <div class="col-6 d-flex">
                            <i data-acorn-icon="building-large" class="me-2 text-primary"></i>
                            <div>
                                <div class="text-muted small">Penyedia</div>
                                <div class="d-flex align-items-center gap-1">
                                    <div class="fw-semibold">RM Padang Pagi Sore</div>
                                    <span class="text-muted small">•</span>
                                    <div class="text-muted small">Restoran</div>
                                </div>

                            </div>
                        </div>
                        <div class="col-6 d-flex">
                            <i data-acorn-icon="grid-1" class="me-2 text-primary"></i>
                            <div>
                                <div class="text-muted small">Berat</div>
                                <div class="fw-semibold">3 kg</div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6 d-flex">
                            <i data-acorn-icon="clock" class="me-2 text-primary"></i>
                            <div>
                                <div class="text-muted small">Batas Pengambilan</div>
                                <div class="fw-semibold">14.30</div>

                            </div>
                        </div>
                        <div class="col-6 d-flex">
                            <i data-acorn-icon="phone" class="me-2 text-primary"></i>
                            <div>
                                <div class="text-muted small">Kontak</div>
                                <div class="fw-semibold">0813-4567-8899</div>
                            </div>
                        </div>
                    </div>

                    <!-- ALAMAT -->
                    <div class="mb-1 d-flex align-items-center">
                        <i data-acorn-icon="pin" class="me-2 text-primary"></i>
                        <span class="text-muted small">Alamat</span>
                    </div>
                    <div class="ms-4 mb-2">
                        Jl. Sudirman No. 45, Jakarta <br>
                        <a href="https://maps.google.com" target="_blank" class="text-primary text-small">
                            Buka di Google Maps
                        </a>
                    </div>
                    <div class="ms-4 mb-3">
                        <a href="https://maps.google.com" target="_blank">
                            <img src="img/maps-thumbnail.png" class="img-fluid rounded shadow-sm" style="width: 100%; max-height: 160px; object-fit: cover;" />
                        </a>
                    </div>

                    <!-- PENERIMA -->
                    <div class="border rounded p-3 bg-light mb-3">
                        <h6 class="fw-bold mb-2">Informasi Penerima</h6>
                        <div class="row mb-3">
                            <div class="col-6 d-flex">
                                <i data-acorn-icon="user" class="me-2 text-primary"></i>
                                <div>
                                    <div class="text-muted small">Nama Penerima</div>
                                    <div class="fw-semibold">Budi Santoso</div>
                                </div>
                            </div>
                            <div class="col-6 d-flex">
                                <i data-acorn-icon="phone" class="me-2 text-primary"></i>
                                <div>
                                    <div class="text-muted small">Nomor Telepon</div>
                                    <div class="fw-semibold">0812-9988-7766</div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6 d-flex">
                                <i data-acorn-icon="archive" class="me-2 text-primary"></i>
                                <div>
                                    <div class="text-muted small">Jumlah Diambil</div>
                                    <div class="fw-semibold">10 Porsi</div>
                                </div>
                            </div>
                            <div class="col-6 d-flex">
                                <i data-acorn-icon="clock" class="me-2 text-primary"></i>
                                <div>
                                    <div class="text-muted small">Batas Waktu Pengambilan</div>
                                    <div class="fw-semibold text-danger">14.30 WIB</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- BUTTON -->
            <div class="p-3 border-top bg-white">
                <button class="btn btn-success w-100" data-bs-dismiss>Konfirmasi Sudah Diambil</button>
            </div>
        </div>
    </div>
</div>

<!-- Search Modal Start -->
<div class="modal fade modal-under-nav modal-search modal-close-out" id="searchPagesModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0 p-0">
                <button type="button" class="btn-close btn btn-icon btn-icon-only btn-foreground" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ps-5 pe-5 pb-0 border-0">
                <input id="searchPagesInput" class="form-control form-control-xl borderless ps-0 pe-0 mb-1 auto-complete" type="text" autocomplete="off" />
            </div>
            <div class="modal-footer border-top justify-content-start ps-5 pe-5 pb-3 pt-3 border-0">
                <span class="text-alternate d-inline-block m-0 me-3">
                    <i data-acorn-icon="arrow-bottom" data-acorn-size="15"
                        class="text-alternate align-middle me-1"></i>
                    <span class="align-middle text-medium">Navigate</span>
                </span>
                <span class="text-alternate d-inline-block m-0 me-3">
                    <i data-acorn-icon="arrow-bottom-left" data-acorn-size="15"
                        class="text-alternate align-middle me-1"></i>
                    <span class="align-middle text-medium">Select</span>
                </span>
            </div>
        </div>
    </div>
</div>
<!-- Search Modal End -->

@endsection