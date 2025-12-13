@extends('dashboard.layouts.app')

@php
$noScripts = true; // set true supaya scripts tidak dijalankan
@endphp

@push('styles')
<link rel="stylesheet" href="{{asset ('css/home.css')}}">
<!-- slide card -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
@endpush

@section('content')

<main>
    <div class="container">
        <!-- Galeri Gambar Section -->
        <div class="container mt-4 mb-5">
            <div id="heroCarousel" class="carousel slide carousel-fade rounded-4 overflow-hidden shadow-lg"
                data-bs-ride="carousel">

                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0"
                        class="active"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
                </div>

                <div class="carousel-inner">

                    <!-- SLIDE 1 -->
                    <div class="carousel-item active" data-bs-interval="4000">
                        <img src="{{asset ('img/hero/hero3.jpg')}}" class="d-block w-100 hero-img" alt="">
                        <div
                            class="carousel-caption d-flex flex-column justify-content-center align-items-start text-start">
                            <h1 class="fw-bold mb-3 text-white">Kurangi Food Waste Mulai dari Sekarang</h1>
                            <p class="mb-4 text-white">Bersama FoodCycle, kelola makanan dan limbah organik
                                menjadi lebih bermanfaat.</p>
                            <a href="{{route ('auth.register')}}" class="btn btn-gradient-primary px-4 py-2">Gabung
                                Sekarang</a>
                        </div>
                    </div>

                    <!-- SLIDE 2 -->
                    <div class="carousel-item" data-bs-interval="4000">
                        <img src="{{asset ('img/hero/hero1.jpg')}}" class="d-block w-100 hero-img" alt="">
                        <div
                            class="carousel-caption d-flex flex-column justify-content-center align-items-start text-start">
                            <h1 class="fw-bold mb-3 text-white">Makanan Layak, Hidup Lebih Baik</h1>
                            <p class="mb-4 text-white">Salurkan makanan berlebih untuk membantu sesama dan
                                menjaga lingkungan.</p>
                            <a href="{{route ('katalog.katalogMakanan.index')}}" class="btn btn-outline-light px-4 py-2">Lihat
                                Katalog</a>
                        </div>
                    </div>

                    <!-- SLIDE 3 -->
                    <div class="carousel-item" data-bs-interval="4000">
                        <img src="{{asset ('img/hero/hero2.jpg')}}" class="d-block w-100 hero-img" alt="">
                        <div
                            class="carousel-caption d-flex flex-column justify-content-center align-items-start text-start">
                            <h1 class="fw-bold mb-3 text-white">Manfaatkan Limbah Organik</h1>
                            <p class="mb-4 text-white">Kelola limbah organik menjadi pupuk dan bahan baru agar
                                lebih berguna.</p>
                            <a href="{{route ('katalog.katalogDaurUlang.index')}}" class="btn btn-outline-light px-4 py-2">Pelajari
                                Lebih Lanjut</a>
                        </div>
                    </div>

                </div>


                <!-- NAV -->
                <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>

            </div>
        </div>

        <!-- Peran Kami & Statistik Section -->
        <div class="row mb-5">
            <h2 class="card-title justify-content-center text-center text-primary mb-4">Tentang Econect</h2>
            <div class="col-12 col-lg-6 d-flex">
                <section class="scroll-section w-100 d-flex flex-column">
                    <div class="card mb-5 h-100">
                        <div class="row g-0 h-100">
                            <div class="col-sm-4">
                                <img src="{{asset ('img/hero/img3.jpg')}}" class="card-img card-img-horizontal-sm h-100 object-fit-cover" />
                            </div>
                            <div class="col-sm-8">
                                <div class="card-body d-flex flex-column h-100 p-4">
                                    <h3 class="card-title text-primary mb-4 mt-4">Peran Kami</h3>
                                    <p class="card-text mb-2">
                                        Econect hadir sebagai penghubung antara masyarakat, kolaborator, dan
                                        aktivis
                                        untuk mengurangi masalah food waste berlebih serta mendukung kegiatan
                                        ramah
                                        lingkungan.
                                    </p>
                                    <p class="card-text">
                                        Bersama, kita kurangi jumlah food waste dengan <strong>Econect!</strong>
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
                                                <p class="cta-3 mb-0 text-primary fw-bold"> {{ $totalMakanan != null ? $totalMakanan : '0' }}</p>
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
                                                <p class="cta-3 mb-0 text-primary fw-bold">{{ $totalDaurUlang != null ? $totalDaurUlang : '0' }}</p>
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
                                                <p class="cta-3 mb-0 text-primary fw-bold">{{ $totalArtikel != null ? $totalArtikel : '0' }}</p>
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
                                                <p class="cta-3 mb-0 text-primary fw-bold">{{ $totalAgenda != null ? $totalAgenda : '0' }}</p>
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
        <div class="row g-3 align-items-stretch mb-5">
            <!-- LEFT SIDE -->
            <div class="col-12 col-lg-8 d-flex mb-5">
                <div class="row g-3 flex-fill">
                    <!-- Kolaborator -->
                    <div class="col-12 col-md-6 d-flex">
                        <div class="card flex-fill text-center py-4">
                            <div
                                class="card-body d-flex flex-column justify-content-center align-items-center h-100">
                                <div
                                    class="sh-5 sw-5 rounded-circle bg-primary d-flex justify-content-center align-items-center mb-3">
                                    <i data-acorn-icon="sync-horizontal" class="text-white"></i>
                                </div>
                                <h4 class="card-title text-success mb-3">Kolaborator</h4>
                                <p class="card-text">
                                    Menyediakan produk makanan layak serta limbah organik untuk dimanfaatkan
                                    kembali, serta dapat menerima produk dari kolaborator lain
                                </p>

                            </div>
                        </div>
                    </div>


                    <!-- Aktivis -->
                    <div class="col-12 col-md-6 d-flex">
                        <div class="card flex-fill text-center py-4">
                            <div
                                class="card-body d-flex flex-column justify-content-center align-items-center h-100">
                                <div
                                    class="sh-5 sw-5 rounded-circle bg-primary d-flex justify-content-center align-items-center mb-3">
                                    <i data-acorn-icon="notification" class="text-white"></i>
                                </div>
                                <h4 class="card-title text-success mb-3">Aktivis</h4>
                                <p class="card-text">
                                    Membagikan artikel, edukasi lingkungan, dan mengadakan agenda peduli alam.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- RIGHT SIDE -->
            <div class="col-12 col-lg-4 d-flex mb-5">
                <div class="card flex-fill position-relative overflow-hidden">
                    <img src="img/hero/img1.jpg" class="img-fluid w-100 h-100 object-fit-cover" />

                    <div class="card-img-overlay d-flex flex-column justify-content-center">
                        <h2 class="text-white mb-4">Informasi Hari Ini</h2>

                        <div class="text-white">
                            <div class="mb-2">
                                <div class="cta-1 fw-bold">{{ $totalMakananInDay != null ? $totalMakananInDay : '0' }}</div>
                                <div>Makanan</div>
                            </div>
                            <div class="mb-2">
                                <div class="cta-1 fw-bold">{{ $totalDaurUlangInDay != null ? $totalDaurUlangInDay : '0' }}</div>
                                <div>Limbah</div>
                            </div>
                            <div>
                                <div class="cta-1 fw-bold"> {{ $totalAgendaInDay != null ? $totalAgendaInDay : '0' }}</div>
                                <div>Agenda</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Data Yang Disumbangkan -->
        <div class="row mb-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="card-title text-primary">Rekomendasi Katalog</h2>
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="dropdown">
                        Lihat Lebih Banyak
                    </button>
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end shadow">
                        <a class="dropdown-item" href="{{ route('katalog.katalogMakanan.index') }}">Makanan</a>
                        <a class="dropdown-item" href="{{ route('katalog.katalogDaurUlang.index') }}">Daur Ulang</a>
                    </div>
                </div>
            </div>

            @if($dataItem->isEmpty())
            <div class="d-flex flex-column justify-content-center align-items-center" style="min-height: 250px;">
                <img src="{{ asset('img/page/no-data.svg') }}" alt="Tidak ada data" class="img-fluid mb-3" style="max-height: 150px;">
                <p class="text-muted mb-0">Belum ada item katalog tersedia.</p>
            </div>
            @else
            <div class="swiper katalogSwiper">
                <div class="swiper-wrapper">
                    @foreach($dataItem as $item)
                    <div class="swiper-slide">
                        <div class="card h-100 card-clickable" data-modal-target="{{ $item instanceof \App\Models\DataMakanan ? '#modalDetailMakanan'.$item->id : '#modalDetailDaurUlang'.$item->id }}">
                            <img src="{{ asset($item->gambar ?? 'img/default-artikel.webp') }}"
                                class="card-img-top card-img-consistent"
                                alt="{{ $item->nama }}">
                            <div class="card-body pb-2">
                                <a href="javascript:void(0)" role="button" class="h5 heading body-link stretched-link">
                                    {{ $item->nama ?? 'Tanpa Judul' }}
                                </a>
                            </div>
                            <div class="card-footer border-0 pt-2 d-flex justify-content-between flex-wrap align-items-center">
                                <div class="d-flex align-items-center mb-1 mb-md-0">
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
                                <div class="d-flex align-items-center">
                                    <i data-acorn-icon="clock" class="text-primary me-1"></i>
                                    <span class="align-middle countdown" data-time="{{ $item->batas_waktu }}"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Navigation -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
            @endif
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
            <h2 class="card-title justify-content-center text-center text-primary mb-5 mt-5">
                Artikel Terbaru Minggu Ini
            </h2>

            <div class="row">
                <div class="col-12 p-0 mb-5">

                    @if($artikels->isEmpty())
                    {{-- Tampilan jika tidak ada artikel --}}
                    <div class="d-flex flex-column justify-content-center align-items-center" style="min-height: 250px;">
                        <img src="{{ asset('img/page/no-data.svg') }}" alt="Tidak ada artikel" class="img-fluid mb-3" style="max-height: 150px;">
                        <p class="text-center text-muted mb-0">Belum ada artikel terbaru dalam 7 hari terakhir.</p>
                    </div>
                    @else
                    {{-- Tampilan Glide jika ada artikel --}}
                    <div class="glide" id="glideBasic">
                        <div class="glide__track" data-glide-el="track">
                            <div class="glide__slides">
                                @foreach($artikels as $artikel)
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
                                                <p class="card-text text-truncate mb-2">{!! \Illuminate\Support\Str::limit(strip_tags($artikel->deskripsi), 100) !!}</p>
                                                <div class="text-muted small mt-auto">
                                                    <i data-acorn-icon="clock" class="me-1"></i>
                                                    {{ \Carbon\Carbon::parse($artikel->created_at)->diffForHumans() }}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Navigasi Glide jika artikel lebih dari 3 --}}
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
                    @endif

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
<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Swiper
        const katalogSwiper = new Swiper('.katalogSwiper', {
            slidesPerView: 4, // tetap 4 per slide
            spaceBetween: 15,
            loop: false,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: false,
            breakpoints: {
                0: {
                    slidesPerView: 4
                }, // mobile tetap 4
                576: {
                    slidesPerView: 4
                },
                992: {
                    slidesPerView: 4
                },
                1200: {
                    slidesPerView: 4
                },
            },
            allowTouchMove: true, // tetap bisa swipe
        });

        // Klik aman untuk modal
        let startX, startY;
        document.querySelectorAll('.card-clickable').forEach(card => {
            card.addEventListener('pointerdown', e => {
                startX = e.clientX;
                startY = e.clientY;
            });
            card.addEventListener('pointerup', e => {
                const dx = Math.abs(e.clientX - startX);
                const dy = Math.abs(e.clientY - startY);
                const threshold = 10;
                if (dx < threshold && dy < threshold) {
                    const modalTarget = card.getAttribute('data-modal-target');
                    const modalEl = document.querySelector(modalTarget);
                    if (modalEl) {
                        const modal = new bootstrap.Modal(modalEl);
                        modal.show();
                    }
                }
            });
        });

        // Countdown HH:MM:SS
        document.querySelectorAll('.countdown').forEach(el => {
            const timeData = el.dataset.time;

            function getTargetDate() {
                const now = new Date();
                const parts = timeData.split(":").map(Number);
                let target = new Date();
                target.setHours(parts[0]);
                target.setMinutes(parts[1] || 0);
                target.setSeconds(parts[2] || 0);
                target.setMilliseconds(0);
                if (target < now) target.setDate(target.getDate() + 1);
                return target;
            }
            const targetTime = getTargetDate();

            function updateCountdown() {
                const now = new Date().getTime();
                const distance = targetTime.getTime() - now;
                if (distance <= 0) {
                    el.textContent = "00:00:00";
                    return;
                }
                const hh = String(Math.floor(distance / (1000 * 60 * 60))).padStart(2, '0');
                const mm = String(Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))).padStart(2, '0');
                const ss = String(Math.floor((distance % (1000 * 60)) / 1000)).padStart(2, '0');
                el.textContent = `${hh}:${mm}:${ss}`;
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