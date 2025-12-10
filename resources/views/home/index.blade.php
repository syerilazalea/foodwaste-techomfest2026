@extends('dashboard.layouts.app')

@php
$noScripts = true; // set true supaya scripts tidak dijalankan
@endphp

@push('styles')

<style>
    .article-card {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .card-img-wrapper {
        height: 200px;
        /* tinggi gambar tetap */
        overflow: hidden;
    }

    .card-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* menjaga gambar tetap proporsional tapi mengisi div */
    }

    .card-body {
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .card-title {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .card-text {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        /* maksimal 3 baris teks */
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* untuk glidejs */
    .glide__arrows button {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        backdrop-filter: blur(6px);
        background: rgba(255, 255, 255, 0.6);
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: .3s ease;
    }

    .glide__arrows button:hover {
        background: rgba(255, 255, 255, 0.85);
        transform: scale(1.1);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .glide__arrows .left-arrow {
        position: absolute;
        left: -25px;
        top: 50%;
        transform: translateY(-10%);
    }

    .glide__arrows .right-arrow {
        position: absolute;
        right: -25px;
        top: 50%;
        transform: translateY(-10%);
    }
</style>

@endpush

@section('content')

<main>
    <div class="container">
        <!-- Galeri Gambar Section -->
        <section class="scroll-section mb-5" id="gallery">
            <div class="glide" id="glideGallery">
                <!-- Large Images Start -->
                <div class="glide glide-large shadow rounded mb-4">
                    <div class="glide__track mb-0" data-glide-el="track">
                        <ul class="glide__slides gallery-glide-custom mb-0">
                            <li class="glide__slide p-0">
                                <a href="{{asset ('img/product/large/product-1.webp')}}">
                                    <img alt="detail" src="{{asset ('img/product/large/product-1.webp')}}" class="responsive border-0 rounded img-fluid sh-50 w-100" />
                                </a>
                            </li>
                            <li class="glide__slide p-0">
                                <a href="{{asset ('img/product/large/product-2.webp')}}">
                                    <img alt="detail" src="{{asset ('img/product/large/product-2.webp')}}" class="responsive border-0 rounded img-fluid sh-50 w-100" />
                                </a>
                            </li>
                            <li class="glide__slide p-0">
                                <a href="{{asset ('img/product/large/product-3.webp')}}">
                                    <img alt="detail" src="{{asset ('img/product/large/product-3.webp')}}" class="responsive border-0 rounded img-fluid sh-50 w-100" />
                                </a>
                            </li>
                            <li class="glide__slide p-0">
                                <a href="{{asset ('img/product/large/product-4.webp')}}">
                                    <img alt="detail" src="{{asset ('img/product/large/product-4.webp')}}" class="responsive border-0 rounded img-fluid sh-50 w-100" />
                                </a>
                            </li>
                            <li class="glide__slide p-0">
                                <a href="{{asset ('img/product/large/product-5.webp')}}">
                                    <img alt="detail" src="{{asset ('img/product/large/product-5.webp')}}" class="responsive border-0 rounded img-fluid sh-50 w-100" />
                                </a>
                            </li>
                            <li class="glide__slide p-0">
                                <a href="{{asset ('img/product/large/product-6.webp')}}">
                                    <img alt="detail" src="{{asset ('img/product/large/product-6.webp')}}" class="responsive border-0 rounded img-fluid sh-50 w-100" />
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Large Images End -->
                <!-- Thumbs Start -->
                <div class="glide glide-thumb mb-3">
                    <div class="glide__track" data-glide-el="track">
                        <ul class="glide__slides">
                            <li class="glide__slide p-0">
                                <img alt="thumb" src="{{asset ('img/product/small/product-1.webp')}}" class="responsive rounded-md img-fluid shadow" />
                            </li>
                            <li class="glide__slide p-0">
                                <img alt="thumb" src="{{asset ('img/product/small/product-2.webp')}}" class="responsive rounded-md img-fluid shadow" />
                            </li>
                            <li class="glide__slide p-0">
                                <img alt="thumb" src="{{asset ('img/product/small/product-3.webp')}}" class="responsive rounded-md img-fluid shadow" />
                            </li>
                            <li class="glide__slide p-0">
                                <img alt="thumb" src="{{asset ('img/product/small/product-4.webp')}}" class="responsive rounded-md img-fluid shadow" />
                            </li>
                            <li class="glide__slide p-0">
                                <img alt="thumb" src="{{asset ('img/product/small/product-5.webp')}}" class="responsive rounded-md img-fluid shadow" />
                            </li>
                            <li class="glide__slide p-0">
                                <img alt="thumb" src="{{asset ('img/product/small/product-6.webp')}}" class="responsive rounded-md img-fluid shadow" />
                            </li>
                        </ul>
                    </div>
                    <div class="glide__arrows" data-glide-el="controls">
                        <button class="btn btn-icon btn-icon-only btn-foreground-alternate shadow left-arrow" data-glide-dir="<">
                            <i data-acorn-icon="chevron-left"></i>
                        </button>
                        <button class="btn btn-icon btn-icon-only btn-foreground-alternate shadow right-arrow" data-glide-dir=">">
                            <i data-acorn-icon="chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Peran Kami & Statistik Section -->
        <div class="row mb-5">
            <h2 class="card-title justify-content-center text-center text-primary mb-4">Tentang Econect</h2>
            <div class="col-12 col-lg-6 d-flex">
                <section class="scroll-section w-100 d-flex flex-column">
                    <div class="card mb-5 h-100">
                        <div class="row g-0 h-100">
                            <div class="col-sm-4">
                                <img src="{{asset ('img/product/small/product-2.webp')}}" class="card-img card-img-horizontal-sm h-100 object-fit-cover" />
                            </div>
                            <div class="col-sm-8">
                                <div class="card-body d-flex flex-column h-100 p-4">
                                    <h3 class="card-title text-primary mb-4 mt-4">Peran Kami</h3>
                                    <p class="card-text mb-2">
                                        Econect hadir sebagai penghubung antara masyarakat, kolaborator, dan aktivis untuk mengurangi masalah food waste berlebih serta mendukung kegiatan ramah lingkungan.
                                    </p>
                                    <p class="card-text">
                                        Bersama, kita kurangi jumlah food waste dengan <strong>Food
                                            Cycle!</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-12 col-lg-6 d-flex">
                <section class="scroll-section w-100 d-flex flex-column">
                    <div class="card p-3 mb-5 h-100">
                        <div class="glide h-100" id="glideAuto">
                            <div class="glide__track h-100 p-3" data-glide-el="track">
                                <div class="glide__slides h-100">
                                    <div class="glide__slide">
                                        <div class="card mb-5 h-100 border-primary">
                                            <div class="h-100 p-4 text-center align-items-center d-flex flex-column justify-content-between">
                                                <div class="d-flex flex-column justify-content-center align-items-center sh-5 sw-5 rounded-xl bg-gradient-light mb-2">
                                                    <i data-acorn-icon="loaf" class="text-white"></i>
                                                </div>
                                                <p class="mb-0 lh-1">Makanan Disalurkan</p>
                                                <p class="cta-3 mb-0 text-primary fw-bold">1.234</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="glide__slide">
                                        <div class="card mb-5 h-100 border-primary">
                                            <div class="h-100 p-4 text-center align-items-center d-flex flex-column justify-content-between">
                                                <div class="d-flex flex-column justify-content-center align-items-center sh-5 sw-5 rounded-xl bg-gradient-light mb-2">
                                                    <i data-acorn-icon="pear" class="text-white"></i>
                                                </div>
                                                <p class="mb-0 lh-1">Limbah Dimanfaatkan</p>
                                                <p class="cta-3 mb-0 text-primary fw-bold">7.675</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="glide__slide">
                                        <div class="card mb-5 h-100 border-primary">
                                            <div class="h-100 p-4 text-center align-items-center d-flex flex-column justify-content-between">
                                                <div class="d-flex flex-column justify-content-center align-items-center sh-5 sw-5 rounded-xl bg-gradient-light mb-2">
                                                    <i data-acorn-icon="book-open" class="text-white"></i>
                                                </div>
                                                <p class="mb-0 lh-1">Artikel Informatif</p>
                                                <p class="cta-3 mb-0 text-primary fw-bold">938</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="glide__slide">
                                        <div class="card mb-5 h-100 border-primary">
                                            <div class="h-100 p-4 text-center align-items-center d-flex flex-column justify-content-between">
                                                <div class="d-flex flex-column justify-content-center align-items-center sh-5 sw-5 rounded-xl bg-gradient-light mb-2">
                                                    <i data-acorn-icon="calendar" class="text-white"></i>
                                                </div>
                                                <p class="mb-0 lh-1">Agenda Terlaksana</p>
                                                <p class="cta-3 mb-0 text-primary fw-bold">37</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <!-- Kategori Pengguna & Informasi Hari Ini Section -->
        <div class="row mb-5">
            <!-- RIGHT SIDE -->
            <div class="col-12 col-lg-8 d-flex flex-column mb-5">
                <h2 class="card-title text-primary mb-4">Kategori Pengguna</h2>

                <!-- Make cards same height as left side -->
                <div class="row g-3 flex-grow-1 align-items-stretch">

                    <!-- Kolaborator -->
                    <div class="col-12 col-md-6 d-flex">
                        <div class="card h-100 flex-fill">
                            <div class="card-body text-center p-5 d-flex flex-column justify-content-center">
                                <h4 class="card-title text-primary mb-4">Kolaborator</h4>
                                <p class="card-text">
                                    Menyediakan makanan layak serta limbah organik untuk dimanfaatkan kembali. Termasuk menerima dan menyalurkan produk organik antar kolaborator.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Aktivis -->
                    <div class="col-12 col-md-6 d-flex">
                        <div class="card h-100 flex-fil">
                            <div class="card-body text-center p-5 d-flex flex-column justify-content-center">
                                <h4 class="card-title text-primary mb-4">Aktivis</h4>
                                <p class="card-text">
                                    Membagikan artikel, edukasi lingkungan, dan mengadakan agenda peduli alam seperti gerakan tanam pohon serta kampanye kebersihan.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- LEFT SIDE -->
            <div class="col-12 col-lg-4 d-flex flex-column mb-5">
                <h2 class="card-title text-primary mb-4">Informasi Hari Ini</h2>

                <div class="card flex-grow-1 position-relative overflow-hidden">
                    <img src="{{asset ('img/product/small/product-6.webp')}}" class="img-fluid rounded mb-1 me-1 w-100 h-100 object-fit-cover" alt="Responsive image" />

                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.45); border-radius: inherit;"></div>

                    <div class="card-img-overlay d-flex flex-column justify-content-center bg-transparent">
                        <div class="d-flex flex-column align-items-start gap-3 text-white">
                            <div>
                                <div class="cta-1 fw-bold mb-1">124</div>
                                <div class="lh-1-25 mb-0">Makanan</div>
                            </div>
                            <div>
                                <div class="cta-1 fw-bold mb-1">64</div>
                                <div class="lh-1-25 mb-0">Limbah</div>
                            </div>
                            <div>
                                <div class="cta-1 fw-bold mb-1">4</div>
                                <div class="lh-1-25 mb-0">Agenda</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Yang Disumbangkan  -->
        <div class="row mb-5">
            <div class="d-flex justify-content-between">
                <h2 class="card-title text-primary">Rekomendasi Katalog</h2>
                <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                    <div class="card-title">Lihat Lebih Banyak</div>
                </button>
                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end shadow">
                    <a class="dropdown-item" href="{{route ('katalog.katalogMakanan.index')}}">Makanan</a>
                    <a class="dropdown-item" href="{{route ('katalog.katalogDaurUlang.index')}}">Daur Ulang</a>
                </div>
            </div>
            <div class="glide" id="glidePenjualan">
                <!-- BULLETS / DOTS -->
                <div class="glide__bullets" data-glide-el="controls[nav]"></div>

                <div class="glide__track" data-glide-el="track">
                    <ul class="glide__slides">
                        @php
                        $perSlide = 4;
                        $chunks = $dataItem->chunk($perSlide);
                        @endphp

                        @foreach($chunks as $chunk)
                        <li class="glide__slide">
                            <div class="row g-4">
                                @foreach($chunk as $item)
                                <div class="col-12 col-lg-3 col-xxl-6 sh-40" data-bs-toggle="modal" data-bs-target="{{ $item instanceof \App\Models\DataMakanan ? '#modalDetailMakanan'.$item->id : '#modalDetailDaurUlang'.$item->id }}">
                                    <div class="card h-100">
                                        <img src="{{ asset($item->gambar ?? 'img/product/product-1.webp') }}" class="card-img-top sh-22" alt="{{ $item->nama }}" />
                                        <div class="card-body pb-0">
                                            <a href="javascript:void(0)" role="button" class="h5 heading body-link stretched-link">
                                                {{ $item->nama ?? 'Tanpa Judul' }}
                                            </a>
                                        </div>
                                        <div class="card-footer border-0 pt-0">
                                            <div class="row g-0">
                                                <div class="col-auto pe-3">
                                                    <i data-acorn-icon="user" class="text-primary me-1"></i>
                                                    <span class="align-middle">
                                                        @if ($item->porsi ?? false)
                                                        {{ $item->porsi }} Porsi
                                                        @elseif ($item->berat ?? false)
                                                        {{ $item->berat }} kg
                                                        @else
                                                        -
                                                        @endif
                                                    </span>
                                                </div>
                                                <div class="col">
                                                    <i data-acorn-icon="clock" class="text-primary me-1"></i>
                                                    <span class="align-middle countdown" data-time="{{ $item->batas_waktu }}"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- NAV -->
                <div class="glide__arrows" data-glide-el="controls">
                    <button class="btn btn-icon btn-icon-only btn-foreground-alternate shadow left-arrow" data-glide-dir="<">
                        <i data-acorn-icon="chevron-left"></i>
                    </button>
                    <button class="btn btn-icon btn-icon-only btn-foreground-alternate shadow right-arrow" data-glide-dir=">">
                        <i data-acorn-icon="chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <section class="pb-5">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between">

                        <!-- Text -->
                        <div class="mb-3 mb-sm-0">
                            <div class="cta-3">Siap Ikut Serta Mengelola Lingkungan?</div>
                            <div class="cta-3 text-primary">Mulailah Sekarang!</div>
                        </div>

                        <!-- Buttons in one row -->
                        <div class="d-flex flex-row">
                            <a href="{{route ('auth.login')}}" class="btn btn-gradient-primary me-2">Masuk</a>
                            <a href="{{route ('auth.register')}}" class="btn btn-outline-primary">Daftar</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Artikel Terbaru Section -->
        <section class="scroll-section mb-5 mt-5" id="basic">
            <h2 class="card-title text-center text-primary mb-5 mt-5">
                Artikel Terbaru Minggu Ini
            </h2>
            <div class="row">
                <div class="col-12 p-0 mb-5">
                    <div class="glide" id="glideBasic">
                        <div class="glide__track" data-glide-el="track">
                            <div class="glide__slides">
                                @forelse($artikels as $artikel)
                                <div class="glide__slide">
                                    <a href="{{ route('home.artikel.show', $artikel->slug) }}" class="text-decoration-none">
                                        <div class="card mb-5 article-card h-100 d-flex flex-column">
                                            <div class="card-img-wrapper">
                                                @if($artikel->gambar)
                                                <img src="{{ asset($artikel->gambar) }}" alt="{{ $artikel->judul }}" class="card-img-top">
                                                @else
                                                <img src="{{ asset('img/default-artikel.webp') }}" alt="default image" class="card-img-top">
                                                @endif
                                            </div>
                                            <div class="card-body flex-grow-1 d-flex flex-column">
                                                <h5 class="card-title text-truncate" title="{{ $artikel->judul }}">{{ $artikel->judul }}</h5>
                                                <p class="card-text text-truncate mb-2">{{ Str::limit($artikel->konten, 100) }}</p>
                                                <div class="text-muted small mt-auto">
                                                    <i data-acorn-icon="clock" class="me-1"></i>
                                                    {{ \Carbon\Carbon::parse($artikel->created_at)->diffForHumans() }}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                @empty
                                <div class="glide__slide">
                                    <p class="text-center text-muted">Belum ada artikel terbaru dalam 7 hari terakhir.</p>
                                </div>
                                @endforelse
                            </div>
                        </div>

                        @if(count($artikels) > 3)
                        <div class="text-center mt-3">
                            <span class="glide__arrows slider-nav" data-glide-el="controls">
                                <button class="btn btn-icon btn-icon-only btn-outline-primary" data-glide-dir="<">
                                    <i data-acorn-icon="chevron-left"></i>
                                </button>
                            </span>
                            <span class="glide__bullets" data-glide-el="controls[nav]"></span>
                            <span class="glide__arrows slider-nav" data-glide-el="controls">
                                <button class="btn btn-icon btn-icon-only btn-outline-primary" data-glide-dir=">">
                                    <i data-acorn-icon="chevron-right"></i>
                                </button>
                            </span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ & CTA Section -->
        <div class="row gy-5 align-items-stretch mb-5">
            <div class="col-12 col-lg-8">
                <div class="mb-n2" id="accordionCardsExample" style="min-height: 350px;">
                    <div class="card d-flex mb-2">
                        <div class="d-flex flex-grow-1" role="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="true">
                            <div class="card-body py-4">
                                <div class="btn btn-link list-item-heading p-0">Apa itu Econect?</div>
                            </div>
                        </div>
                        <div id="faq1" class="collapse show" data-bs-parent="#accordionCardsExample">
                            <div class="card-body accordion-content pt-0">
                                <p class="mb-0">
                                    Econect adalah platform untuk mengurangi food waste dengan menyalurkan makanan layak konsumsi dan mengolah limbah organik.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="card d-flex mb-2">
                        <div class="d-flex flex-grow-1" role="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                            <div class="card-body py-4">
                                <div class="btn btn-link list-item-heading p-0">Siapa bisa jadi kolaborator?
                                </div>
                            </div>
                        </div>
                        <div id="faq2" class="collapse" data-bs-parent="#accordionCardsExample">
                            <div class="card-body accordion-content pt-0">
                                <p class="mb-0">
                                    Restoran, kafe, hotel, UMKM, peternak, pengolah kompos, atau individu.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="card d-flex mb-2">
                        <div class="d-flex flex-grow-1" role="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                            <div class="card-body py-4">
                                <div class="btn btn-link list-item-heading p-0">Apa tugas aktivis?</div>
                            </div>
                        </div>
                        <div id="faq3" class="collapse" data-bs-parent="#accordionCardsExample">
                            <div class="card-body accordion-content pt-0">
                                <p class="mb-0">
                                    Membuat artikel, berbagi informasi, dan mempublikasikan kegiatan peduli lingkungan.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="card d-flex mb-2">
                        <div class="d-flex flex-grow-1" role="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                            <div class="card-body py-4">
                                <div class="btn btn-link list-item-heading p-0">Bagaimana cara daftar?</div>
                            </div>
                        </div>
                        <div id="faq4" class="collapse" data-bs-parent="#accordionCardsExample">
                            <div class="card-body accordion-content pt-0">
                                <p class="mb-0">
                                    Daftar melalui halaman pendaftaran dan lengkapi data yang diperlukan.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-12 col-xl-4">
                <div class="card h-100 flex-fill d-flex flex-column">
                    <div class="card-body d-flex flex-column flex-grow-1">
                        <div class="cta-3 mb-2 text-primary mt-4">Kontribusi Kecil Berdampak Nyata</div>
                        <div class="mb-4">Langkah kecilmu berdampak besar!</div>
                        <div class="text-muted mb-4 flex-grow-1">
                            Ikut serta dalam aksi peduli lingkungan, ikuti agenda dan event yang meningkatkan kesadaran komunitas. Jelajahi artikel, panduan, dan tips praktis untuk mulai berkontribusi dan membuat dampak nyata bagi lingkungan yang lebih bersih dan berkelanjutan.
                        </div>
                        <a href="{{route ('auth.register')}}" class="btn btn-icon btn-icon-start btn-primary mt-auto mb-4">
                            <i data-acorn-icon="chevron-right"></i>
                            <span>Bergabung</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- modal pemesanan -->
@foreach($dataItem as $makanan)
<div class="modal fade" id="modalDetailMakanan{{ $makanan->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form action="{{ route('katalog.katalogMakanan.ambil', $makanan->id) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Detail Makanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <!-- Nama -->
                    <h5 class="mb-3 fw-bold">{{ $makanan->nama }}</h5>

                    <!-- Info utama -->
                    <div class="mb-3">
                        <div><strong>Jumlah Tersedia:</strong> {{ $makanan->porsi }} Porsi</div>
                        <div><strong>Batas Pengambilan:</strong> {{ \Carbon\Carbon::parse($makanan->batas_waktu)->format('H:i') }} WIB</div>
                    </div>

                    <!-- Info penyedia -->
                    <div class="border rounded p-3 bg-light mb-3">
                        <div><strong>Penyedia:</strong> {{ $makanan->penyedia }}</div>
                        <div><strong>Jenis:</strong> {{ $makanan->kategori }}</div>
                        <div><strong>Alamat:</strong> {{ $makanan->alamat }}</div>
                    </div>

                    <!-- Input jumlah yang ingin diambil -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Jumlah yang Ingin Diambil</label>
                        <input type="number" name="jumlah" id="ambilJumlah{{ $makanan->id }}" class="form-control" min="1" placeholder="Masukkan jumlah..." />
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" makanan-bs-dismiss="modal">Tutup</button>
                    @auth
                    {{-- Jika user login --}}
                    <button type="submit" class="btn btn-primary" onclick="handleKonfirmasi({{ $makanan->id }})">
                        Konfirmasi Pengambilan
                    </button>
                    @else
                    {{-- Jika user tidak login --}}
                    <a href="{{ route('auth.login') }}" class="btn btn-primary">
                        Login Untuk Mengambil
                    </a>
                    @endauth
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach


@foreach($dataItem as $daurUlang)
<div class="modal fade" id="modalDetailDaurUlang{{ $daurUlang->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form action="{{ route('katalog.katalaogDaurUlang.ambil', $daurUlang->id) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Detail Daur Ulang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <!-- Nama -->
                    <h5 class="mb-3 fw-bold">{{ $daurUlang->nama }}</h5>

                    <!-- Info utama -->
                    <div class="mb-3">
                        <div><strong>Jumlah Tersedia:</strong> {{ $daurUlang->berat }} kg</div>
                        <div><strong>Batas Pengambilan:</strong> {{ \Carbon\Carbon::parse($daurUlang->batas_waktu)->format('H:i') }} WIB</div>
                    </div>

                    <!-- Info penyedia -->
                    <div class="border rounded p-3 bg-light mb-3">
                        <div><strong>Penyedia:</strong> {{ $daurUlang->penyedia }}</div>
                        <div><strong>Jenis:</strong> {{ $daurUlang->kategori }}</div>
                        <div><strong>Alamat:</strong> {{ $daurUlang->alamat }}</div>
                    </div>

                    <!-- Input jumlah yang ingin diambil -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Jumlah yang Ingin Diambil</label>
                        <input type="number" name="jumlah" id="ambilJumlah{{ $daurUlang->id }}" pattern="[0-9]+([,\.][0-9]+)?" class="form-control" min="0" step="0.1" placeholder="Masukkan jumlah..." />
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>

                    @auth
                    {{-- Jika user login --}}
                    <button type="submit" class="btn btn-primary" onclick="handleKonfirmasi({{ $daurUlang->id }})">
                        Konfirmasi Pengambilan
                    </button>
                    @else
                    {{-- Jika user tidak login --}}
                    <a href="{{ route('auth.login') }}" class="btn btn-primary">
                        Login Untuk Mengambil
                    </a>
                    @endauth
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection

@push('scripts')
<!-- Vendor Scripts Start -->
<script src="{{asset ('js/vendor/jquery-3.5.1.min.js')}}"></script>
<script src="{{asset ('js/vendor/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset ('js/vendor/OverlayScrollbars.min.js')}}"></script>
<script src="{{asset ('js/vendor/autoComplete.min.js')}}"></script>
<script src="{{asset ('js/vendor/clamp.min.js')}}"></script>
<script src="{{asset ('js/vendor/jquery.barrating.min.js')}}"></script>
<script src="{{asset ('icon/acorn-icons.js')}}"></script>
<script src="{{asset ('icon/acorn-icons-interface.js')}}"></script>
<script src="{{asset ('js/vendor/Chart.bundle.min.js')}}"></script>
<script src="{{asset ('js/vendor/chartjs-plugin-datalabels.js')}}"></script>
<script src="{{asset ('js/vendor/chartjs-plugin-rounded-bar.min.js')}}"></script>
<script src="{{asset ('js/vendor/glide.min.js')}}"></script>
<script src="{{asset ('js/vendor/intro.min.js')}}"></script>
<script src="{{asset ('js/vendor/select2.full.min.js')}}"></script>
<script src="{{asset ('js/vendor/plyr.min.js')}}"></script>
<script src="{{asset ('js/cs/responsivetab.js')}}"></script>
<script src="{{asset ('js/vendor/baguetteBox.min.js')}}"></script>
<script src="{{asset ('js/vendor/autosize.min.js')}}"></script>
<script src="{{asset ('js/vendor/moment-with-locales.min.js')}}"></script>

<!-- Vendor Scripts End -->

<!-- Template Base Scripts Start -->
<script src="{{asset ('js/base/helpers.js')}}"></script>
<script src="{{asset ('js/base/globals.js')}}"></script>
<script src="{{asset ('js/base/nav.js')}}"></script>
<script src="{{asset ('js/base/search.js')}}"></script>
<script src="{{asset ('js/base/settings.js')}}"></script>
<!-- Template Base Scripts End -->
<!-- Page Specific Scripts Start -->
<script src="{{asset ('js/cs/glide.custom.js')}}"></script>
<script src="{{asset ('js/cs/charts.extend.js')}}"></script>
<script src="{{asset ('js/pages/dashboard.default.js')}}"></script>
<script src="{{asset ('js/pages/dashboard.visual.js')}}"></script>
<script src="{{asset ('js/common.js')}}"></script>
<script src="{{asset ('js/scripts.js')}}"></script>
<script src="{{asset ('js/plugins/carousels.js')}}"></script>
<script src="{{asset ('js/pages/blog.detail.js')}}"></script>

<script>
    window.addEventListener('load', function() {
        const glideElement = document.querySelector('#glidePenjualan');
        if (glideElement) {
            new Glide(glideElement, {
                type: 'carousel',
                autoplay: 3500,
                hoverpause: true,
                animationDuration: 600,
                perView: 1,
                swipeThreshold: 80,
                dragThreshold: 120
            }).mount();
        }
    });
</script>

<!-- menghitung mundur batas waktu -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const countdownElements = document.querySelectorAll(".countdown");

        countdownElements.forEach(el => {
            const timeOnly = el.dataset.time;

            function getTargetDate() {
                const now = new Date();
                const [hour, minute, second] = timeOnly.split(":").map(Number);

                let target = new Date();
                target.setHours(hour);
                target.setMinutes(minute || 0);
                target.setSeconds(second || 0);
                target.setMilliseconds(0);

                // Jika waktu sudah lewat → hitung untuk besok
                if (target < now) {
                    target.setDate(target.getDate() + 1);
                }
                return target;
            }

            const targetTime = getTargetDate();

            function updateCountdown() {
                const now = new Date().getTime();
                const distance = targetTime.getTime() - now;

                if (distance <= 0) {
                    el.textContent = "Waktu Habis";
                    return;
                }

                const hours = Math.floor(distance / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                if (hours > 0) {
                    el.textContent = `${hours} Jam ${minutes} Menit`;
                } else if (minutes > 0) {
                    el.textContent = `${minutes} Menit ${seconds} Detik`;
                } else {
                    el.textContent = `${seconds} Detik`;
                }
            }

            updateCountdown();
            setInterval(updateCountdown, 1000);
        });
    });
</script>

<script>
    document.addEventListener('click', function(e) {
        const a = e.target.closest('a[href="#"]');
        if (a) e.preventDefault();
    });
</script>

<!-- Laravel PWA Service Worker Registration -->
<script type="text/javascript">
    // Initialize the service worker
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register("{{asset ('serviceworker.js')}}", {
            scope: '.'
        }).then(function(registration) {
            // Registration was successful
            console.log('Laravel PWA: ServiceWorker registration successful with scope: ', registration.scope);
        }, function(err) {
            // registration failed :(
            console.log('Laravel PWA: ServiceWorker registration failed: ', err);
        });
    }
</script>

@endpush