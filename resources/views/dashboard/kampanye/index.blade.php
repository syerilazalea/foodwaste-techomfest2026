@extends('dashboard.layouts.app')

@section('content')

@php
use Carbon\Carbon;
Carbon::setLocale('id'); // set locale ke Indonesia
@endphp

<main>
    <div class="container">
        @include('dashboard.components.breadcrumbs')
        <div class="row">
            <div class="col-12">
                <div class="page-title-container">
                    <p class="mb-0 text-muted">Kelola artikel edukasi dan agenda kegiatan lingkungan</p>
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <!-- STATISTIK (KIRI) -->
            <div class="col-12 col-lg-6">
                <h2 class="small-title">Statistik Kampanye</h2>
                <div class="row g-2">
                    <!-- Total Artikel -->
                    <div class="col-12 col-sm-3">
                        <div class="card hover-scale-up sh-19">
                            <div class="h-100 d-flex flex-column justify-content-between card-body align-items-center">
                                <div class="bg-gradient-light sh-5 sw-5 rounded-xl d-flex justify-content-center align-items-center mb-2">
                                    <i data-acorn-icon="file-text" class="text-white"></i>
                                </div>
                                <div class="heading text-center lh-1">Artikel</div>
                                <div class="text-small text-primary">{{ $totalArtikel}} Item</div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Agenda -->
                    <div class="col-12 col-sm-3">
                        <div class="card hover-scale-up sh-19">
                            <div class="h-100 d-flex flex-column justify-content-between card-body align-items-center">
                                <div class="bg-gradient-light sh-5 sw-5 rounded-xl d-flex justify-content-center align-items-center mb-2">
                                    <i data-acorn-icon="notebook-1" class="text-white"></i>
                                </div>
                                <div class="heading text-center lh-1">Agenda</div>
                                <div class="text-small text-primary">{{ $totalAgenda}} Item</div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Artikel dan Agenda -->
                    <div class="col-12 col-sm-6">
                        <div class="card hover-scale-up sh-19">
                            <div class="h-100 d-flex flex-column justify-content-between card-body align-items-center">
                                <div class="bg-gradient-light sh-5 sw-5 rounded-xl d-flex justify-content-center align-items-center mb-2">
                                    <i data-acorn-icon="eye" class="text-white"></i>
                                </div>
                                <div class="heading text-center lh-1">Artikel & Agenda</div>
                                <div class="text-small text-primary">{{ $totalArtikelAgenda}} Item</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- QUICK ACTIONS (KANAN) -->
            <div class="col-12 col-lg-6">
                <h2 class="small-title">Quick Actions</h2>
                <div class="row g-2">
                    <!-- Buat Artikel -->
                    <div class="col-12 col-sm-6">
                        <a href="{{route ('dashboard.artikel.index')}}" class="text-decoration-none">
                            <div class="card hover-scale-up cursor-pointer sh-19">
                                <div class="h-100 d-flex flex-column justify-content-between card-body align-items-center">
                                    <div class="bg-gradient-light sh-5 sw-5 rounded-xl d-flex justify-content-center align-items-center mb-2">
                                        <i data-acorn-icon="clipboard" class="text-white"></i>
                                    </div>
                                    <div class="heading text-center lh-1">Buat Artikel</div>
                                    <div class="text-small text-primary">Tulis artikel</div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Buat Agenda -->
                    <div class="col-12 col-sm-6">
                        <a href="{{route ('dashboard.agenda.index')}}" class="text-decoration-none">
                            <div class="card hover-scale-up cursor-pointer sh-19">
                                <div class="h-100 d-flex flex-column justify-content-between card-body align-items-center">
                                    <div class="bg-gradient-light sh-5 sw-5 rounded-xl d-flex justify-content-center align-items-center mb-2">
                                        <i data-acorn-icon="content" class="text-white"></i>
                                    </div>
                                    <div class="heading text-center lh-1">Buat Agenda</div>
                                    <div class="text-small text-primary">Rencanakan agenda</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Artikel Terbaru -->
        <div class="row">
            <div class="col-12 col-xl-6 mb-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="small-title mb-0">Artikel Terbaru</h2>
                    <a href="{{route ('dashboard.artikel.index')}}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                </div>
                <div class="scroll-out">
                    <div class="scroll-by-count" data-count="4">

                        @forelse($artikels as $artikel)
                        <div class="card mb-2">
                            <div class="row g-0 sh-12">
                                <div class="col-auto" style="flex-shrink: 0; width: 150px; height: 100px; position: relative;">
                                    @php
                                    $badgeClass = $artikel->status === 'Published' ? 'bg-success' : 'bg-info';
                                    @endphp
                                    <span class="badge rounded-pill {{ $badgeClass }} me-1 position-absolute s-n2 t-2 z-index-1">
                                        {{ $artikel->status }}
                                    </span>

                                    <img src="{{ asset($artikel->gambar) }}"
                                        alt="Artikel"
                                        class="card-img card-img-horizontal"
                                        style="width: 100%; height: 96%; object-fit: cover;" />
                                </div>

                                <div class="col">
                                    <div class="card-body pt-0 pb-0 h-100">
                                        <div class="row g-0 h-100 align-content-center">
                                            <div class="col-12 col-md-7 d-flex flex-column mb-2 mb-md-0">
                                                <span class="fw-bold">{{ $artikel->judul }}</span>
                                                <div class="text-small text-muted">
                                                    <i data-acorn-icon="clock" class="me-1"></i>
                                                    Dibuat: {{ Carbon::parse($artikel->created_at)->diffForHumans() }}
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-5 d-flex align-items-center justify-content-md-end">
                                                <button class="btn btn-sm btn-icon btn-icon-only btn-outline-primary me-2"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalEditArtikel{{ $artikel->id }}">
                                                    <i data-acorn-icon="edit"></i>
                                                </button>

                                                @if(strtolower($artikel->status) === 'draft')
                                                <form action="{{ route('dashboard.kampanyeArtikel.updateStatusArtikel', $artikel->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    <button class="btn btn-sm btn-icon btn-icon-only btn-outline-primary">
                                                        <i data-acorn-icon="upload"></i>
                                                    </button>
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @empty
                        <!-- FULL EMPTY STATE -->
                        <div class="d-flex flex-column justify-content-center align-items-center text-center"
                            style="min-height: 300px;">
                            <img src="{{ asset('img/page/no-data.svg') }}"
                                class="img-fluid mb-3"
                                style="max-height: 160px;">
                            <p class="text-muted mb-0">
                                Kamu belum memiliki artikel.
                            </p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Agenda Mendatang -->
            <div class="col-12 col-xl-6 mb-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="small-title mb-0">Agenda Mendatang</h2>
                    <a href="{{route ('dashboard.agenda.index')}}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                </div>
                <div class="scroll-out">
                    <div class="scroll-by-count" data-count="4">
                        @forelse($agendas as $agenda)
                        <div class="card mb-2">
                            <div class="row g-0 sh-12">
                                <div class="col-auto" style="flex-shrink: 0; width: 150px; height: 100px; position: relative;">
                                    <span class="badge rounded-pill {{ $agenda->status === 'Aktif' ? 'bg-info' : 'bg-primary' }} me-1 position-absolute s-n2 t-2 z-index-1 t-1">
                                        {{ ucfirst($agenda->status) }}
                                    </span>
                                    <img src="{{ asset($agenda->gambar) }}"
                                        alt="Agenda"
                                        class="card-img card-img-horizontal"
                                        style="width: 100%; height: 96%; object-fit: cover;" />
                                </div>
                                <div class="col">
                                    <div class="card-body pt-0 pb-0 h-100">
                                        <div class="row g-0 h-100 align-content-center">
                                            <div class="col-12 col-md-7 d-flex flex-column mb-2 mb-md-0">
                                                <span class="fw-bold">{{ $agenda->nama_kegiatan }}</span>
                                                <div class="text-small text-muted">
                                                    <i data-acorn-icon="clock" class="me-1"></i> Dibuat: {{ Carbon::parse($agenda->created_at)->diffForHumans() }}
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-5 d-flex align-items-center justify-content-md-end">
                                                <button class="btn btn-sm btn-icon btn-icon-only btn-outline-primary mb-1 me-2"
                                                    type="button"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalEditAgenda{{ $agenda->id }}">
                                                    <i data-acorn-icon="edit"></i>
                                                </button>
                                                @if(strtolower($agenda->status) === 'nonaktif')
                                                <form action="{{ route('dashboard.kampanyeAgenda.updateStatusAgenda', $agenda->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('POST')
                                                    <button class="btn btn-sm btn-icon btn-icon-only btn-outline-primary mb-1" type="submit">
                                                        <i data-acorn-icon="upload"></i>
                                                    </button>
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <!-- FULL EMPTY STATE -->
                        <div class="d-flex flex-column justify-content-center align-items-center text-center"
                            style="min-height: 300px;">
                            <img src="{{ asset('img/page/no-data.svg') }}"
                                class="img-fluid mb-3"
                                style="max-height: 160px;">
                            <p class="text-muted mb-0">
                                Kamu belum memiliki artikel.
                            </p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@foreach($artikels as $artikel)
<div class="modal fade" id="modalEditArtikel{{ $artikel->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('dashboard.kampanyeArtikel.update', $artikel->slug) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Artikel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Judul Artikel</label>
                        <input type="text" class="form-control" name="judul" value="{{ $artikel->judul }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Konten Artikel</label>
                        <textarea class="form-control" name="deskripsi" rows="6">{!! $artikel->deskripsi !!}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gambar Utama</label>
                        <input type="file" name="gambar" class="form-control" accept="image/*">
                        @if($artikel->gambar)
                        <div class="form-text mt-1">
                            Gambar saat ini:
                            <img src="{{ asset($artikel->gambar) }}" class="rounded sw-4 sh-4 ms-2">
                        </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select class="form-select" name="kategori">
                            <option value="edukasi" {{ $artikel->kategori == 'edukasi' ? 'selected' : '' }}>Edukasi</option>
                            <option value="tips & trik" {{ $artikel->kategori == 'tips & trik' ? 'selected' : '' }}>Tips & Trik</option>
                            <option value="berita" {{ $artikel->kategori == 'berita' ? 'selected' : '' }}>Berita</option>
                            <option value="tutorial" {{ $artikel->kategori == 'tutorial' ? 'selected' : '' }}>Tutorial</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update Artikel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@foreach($agendas as $agenda)
<div class="modal fade" id="modalEditAgenda{{ $agenda->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('dashboard.kampanyeAgenda.update', $agenda->slug) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Agenda</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Judul Agenda</label>
                        <input type="text" name="nama_kegiatan" class="form-control" value="{{ $agenda->nama_kegiatan }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Konten Agenda</label>
                        <textarea name="deskripsi" class="form-control" rows="6">{{ $agenda->deskripsi }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gambar Utama</label>
                        <input type="file" name="gambar" class="form-control" accept="image/*">
                        @if($agenda->gambar)
                        <div class="form-text mt-1">
                            Gambar saat ini:
                            <img src="{{ asset($agenda->gambar) }}" class="rounded sw-4 sh-4 ms-2">
                        </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" value="{{ $agenda->tanggal }}" required>
                    </div>
                    <div class="mb-3 d-flex gap-2">
                        <div>
                            <label class="form-label">Waktu Mulai</label>
                            <input type="time" name="waktu_mulai" class="form-control" value="{{ $agenda->waktu_mulai }}" required>
                        </div>
                        <div>
                            <label class="form-label">Waktu Selesai</label>
                            <input type="time" name="waktu_selesai" class="form-control" value="{{ $agenda->waktu_selesai }}" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Lokasi</label>
                        <input type="text" name="lokasi" class="form-control" value="{{ $agenda->lokasi }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kuota</label>
                        <input type="number" name="kuota" class="form-control" value="{{ $agenda->kuota }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="Aktif" {{ $agenda->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Nonaktif" {{ $agenda->status == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update Agenda</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection