@extends('dashboard.layouts.app')

@section('content')

<main>
    <div class="container">
        <div class="page-title-container">
            <div class="row"></div>
        </div>
        <div class="card mb-5">
            <div class="card-body p-0">
                @if($agenda->gambar)
                <img alt="{{ $agenda->nama_kegiatan }}" src="{{ asset($agenda->gambar) }}" class="responsive border-0 rounded-top-end rounded-top-start img-fluid mb-3 sh-50 w-100" />
                @else
                <img alt="Default Image" src="{{ asset('img/default-agenda.webp') }}" class="responsive border-0 rounded-top-end rounded-top-start img-fluid mb-3 sh-50 w-100" />
                @endif

                <div class="card-body pt-3">
                    <h4 class="mb-3">{{ $agenda->nama_kegiatan }}</h4>

                    <div class="mb-4">
                        <p class="mb-1">
                            <i data-acorn-icon="clock" class="me-1 text-primary" data-acorn-size="18"></i>
                            <strong>{{ \Carbon\Carbon::parse($agenda->tanggal)->format('d M Y') }} | {{ $agenda->waktu_mulai }} – {{ $agenda->waktu_selesai }} WIB</strong>
                        </p>
                        <p class="mb-3">
                            <i data-acorn-icon="pin" class="me-1 text-danger" data-acorn-size="18"></i>
                            <strong>{{ $agenda->lokasi }}</strong>
                        </p>
                    </div>

                    <p>{!! $agenda->deskripsi !!}</p>

                    @if($agenda->dresscode)
                    <h6 class="mb-3 mt-5 text-alternate">Dresscode</h6>
                    <p class="mb-4"><strong>{{ $agenda->dresscode }}</strong></p>
                    @endif

                    @if($agenda->barang_bawa)
                    <h6 class="mb-3 mt-4 text-alternate">Barang yang Perlu Dibawa</h6>
                    <ul class="list-unstyled">
                        @foreach(explode(',', $agenda->barang_bawa) as $item)
                        <li>• {{ trim($item) }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>



@endsection