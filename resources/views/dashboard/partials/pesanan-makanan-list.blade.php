@if ($pesananMakanan->count())
{{-- SCROLL HANYA UNTUK LIST --}}
<div class="scroll-out">
    <div class="scroll-by-count" data-count="4">
        @foreach ($pesananMakanan as $item)
        <div class="card mb-2">
            <div class="row g-0 sh-12">
                <div class="col-auto">
                    <span
                        class="badge rounded-pill
                                            @if($item->status == 'diambil')
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

@else
{{-- EMPTY STATE (DI LUAR SCROLL) --}}
<div class="d-flex flex-column justify-content-center align-items-center py-5">
    <img src="{{ asset('img/page/no-data.svg') }}"
        alt="Tidak ada makanan"
        class="img-fluid mb-3"
        style="max-height: 150px;">

    <p class="text-muted mb-0 text-center">
        Belum ada pesanan makanan saat ini.
    </p>
</div>
@endif