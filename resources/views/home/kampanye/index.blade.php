@extends('dashboard.layouts.app')

@section('content')

<main>
    <div class="container">
        @include('dashboard.components.breadcrumbs')
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row">
            </div>
        </div>
        <!-- Title and Top Buttons End -->


        <!-- Main Content -->
        <div class="mt-5">
            <ul class="nav nav-tabs nav-tabs-title nav-tabs-line-title responsive-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" data-bs-toggle="tab" href="#artikelTab" role="tab"
                        aria-selected="true">Koleksi Artikel</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#agendaTab" role="tab"
                        aria-selected="false">Agenda Mendatang</a>
                </li>
                <li class="nav-item dropdown ms-auto d-none responsive-tab-dropdown">
                    <a class="btn btn-icon btn-icon-only btn-background pt-0" href="#" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        data-diplay="static">
                        <i data-acorn-icon="more-horizontal"></i>
                    </a>
                    <ul class="dropdown-menu mt-2 dropdown-menu-end"></ul>
                </li>
            </ul>
            <div class="tab-content">
                <!-- Tab Artikel -->
                <div class="tab-pane fade @if($artikels->count()) active show @endif" id="artikelTab" role="tabpanel">
                    @if($artikels->count())
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-xxl-3 g-2 mb-5" id="artikelContainer">
                        @foreach($artikels as $artikel)
                        <div class="col">
                            <a href="{{ route('home.artikel.show', $artikel->slug) }}" class="text-decoration-none">
                                <div class="card m-2 h-100">
                                    @if($artikel->gambar)
                                    <img src="{{ asset($artikel->gambar) }}" class="card-img-top sh-20" alt="{{ $artikel->judul }}">
                                    @else
                                    <img src="img/default-artikel.webp" class="card-img-top sh-20" alt="default image">
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $artikel->judul }}</h5>
                                        <p class="card-text">{!! \Illuminate\Support\Str::limit(strip_tags($artikel->deskripsi), 100) !!}</p>
                                        @php
                                        $lastRead = auth()->check()
                                        ? $artikel->readers()->where('user_id', auth()->id())->first()?->pivot->last_read_at
                                        : null;
                                        @endphp

                                        <div class="text-muted small">
                                            <i data-acorn-icon="clock" class="me-1"></i>
                                            @guest
                                            {{ \Carbon\Carbon::parse($artikel->created_at)->diffForHumans() }}
                                            @else
                                            @if($lastRead)
                                            {{ \Carbon\Carbon::parse($lastRead)->diffForHumans() }}
                                            @else
                                            {{ \Carbon\Carbon::parse($artikel->created_at)->diffForHumans() }}
                                            @endif
                                            @endguest
                                        </div>

                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>

                    <div class="text-center">
                        <button id="loadMoreArtikel" class="btn btn-xl btn-outline-primary sw-30" data-skip="4" @if($totalArtikel <=4) style="display:none" @endif>Muat Lebih Banyak</button>
                    </div>
                    @else
                    <div class="d-flex flex-column justify-content-center align-items-center text-center" style="min-height: 300px;">
                        <img src="{{ asset('img/page/no-data.svg') }}" class="img-fluid mb-3" style="max-height: 160px;" alt="Tidak ada artikel">
                        <h5 class="text-muted">Belum ada artikel tersedia</h5>
                        <p class="text-muted mb-0">Artikel akan muncul setelah tersedia.</p>
                    </div>
                    @endif
                </div>

                <!-- Tab Agenda -->
                <div class="tab-pane fade @if($agendas->count()) @else active show @endif" id="agendaTab" role="tabpanel">
                    @if($agendas->count())
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-xxl-3 g-2 mb-5" id="agendaContainer">
                        @foreach($agendas as $agenda)
                        <div class="col">
                            <div class="card sh-35 hover-img-scale-up hover-reveal">
                                @if($agenda->gambar)
                                <img src="{{ asset($agenda->gambar) }}" class="card-img h-100 scale" alt="card image">
                                @else
                                <img src="img/default-agenda.webp" class="card-img h-100 scale" alt="default image">
                                @endif
                                <div class="card-img-overlay d-flex flex-column justify-content-between reveal-content">
                                    <div class="row g-0">
                                        <div class="col-auto pe-3">
                                            <i data-acorn-icon="clock" class="text-white me-1" data-acorn-size="15"></i>
                                            <span class="align-middle text-white">{{ $agenda->waktu_mulai }} - {{ $agenda->waktu_selesai }} WIB</span>
                                        </div>
                                        <div class="col-auto">
                                            <i data-acorn-icon="pin" class="text-white me-1" data-acorn-size="15"></i>
                                            <span class="align-middle text-white">{{ $agenda->lokasi }}</span>
                                        </div>
                                    </div>
                                    <div class="row g-0">
                                        <div class="col pe-2">
                                            <a href="{{ route('home.agenda.show', $agenda->slug) }}" class="stretched-link">
                                                <h5 class="heading text-white mb-1">{{ $agenda->user->name }}</h5>
                                            </a>
                                            <div class="d-inline-block">
                                                <div class="text-white text-muted">{{ $agenda->nama_kegiatan }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="text-center">
                        <button id="loadMoreAgenda" class="btn btn-xl btn-outline-primary sw-30" data-skip="4" @if($totalAgenda <=4) style="display:none" @endif>Muat Lebih Banyak</button>
                    </div>
                    @else
                    <!-- EMPTY STATE FULL WIDTH -->
                    <div class="d-flex flex-column justify-content-center align-items-center text-center" style="min-height: 300px;">
                        <img src="{{ asset('img/page/no-data.svg') }}" class="img-fluid mb-3" style="max-height: 160px;" alt="Tidak ada artikel">
                        <h5 class="text-muted">Belum ada agenda tersedia</h5>
                        <p class="text-muted mb-0">Agenda akan muncul setelah tersedia.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>

@endsection

@push('scripts')

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const loadMoreBtn = document.getElementById("loadMoreArtikel");
        const container = document.getElementById("artikelContainer");

        loadMoreBtn.addEventListener("click", function() {
            let skip = parseInt(this.getAttribute("data-skip"));

            fetch("{{ route('home.artikel.loadMore') }}?skip=" + skip)
                .then(response => response.json())
                .then(data => {
                    container.insertAdjacentHTML("beforeend", data.html);

                    // Update skip untuk next load
                    skip += data.count;
                    this.setAttribute("data-skip", skip);

                    // Jika tidak ada lagi artikel, sembunyikan tombol
                    if (data.count < 4) {
                        this.style.display = "none";
                    }
                });
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const loadMoreAgendaBtn = document.getElementById("loadMoreAgenda");
        const agendaContainer = document.getElementById("agendaContainer");

        loadMoreAgendaBtn.addEventListener("click", function() {
            let skip = parseInt(this.getAttribute("data-skip"));

            fetch("{{ route('home.agenda.loadMore') }}?skip=" + skip)
                .then(response => response.json())
                .then(data => {
                    agendaContainer.insertAdjacentHTML("beforeend", data.html);

                    skip += data.count;
                    this.setAttribute("data-skip", skip);

                    if (data.count < 4) {
                        this.style.display = "none";
                    }
                });
        });
    });
</script>

@endpush