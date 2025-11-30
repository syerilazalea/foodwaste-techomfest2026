@extends('dashboard.layouts.app')

@section('content')

<main>
    <div class="container">
        <div class="page-title-container">
            <div class="row">
                <div class="col-12">
                    <h1 class="mb-4">{{ $artikel->judul }}</h1>
                    <div class="text-muted small">
                        <i data-acorn-icon="clock" class="me-1"></i>
                        {{ \Carbon\Carbon::parse($artikel->created_at)->format('d M Y') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-5">
            <div class="card-body p-0">
                @if($artikel->gambar)
                <img alt="{{ $artikel->judul }}" src="{{ asset($artikel->gambar) }}"
                    class="responsive border-0 rounded-top-end rounded-top-start img-fluid mb-3 sh-50 w-100" />
                @else
                <img alt="default image" src="img/default-artikel.webp"
                    class="responsive border-0 rounded-top-end rounded-top-start img-fluid mb-3 sh-50 w-100" />
                @endif

                <div class="card-body pt-3">
                    <h4 class="mb-3">{{ $artikel->judul }}</h4>

                    {{ $artikel->deskripsi }}

                </div>
            </div>
        </div>
    </div>
</main>


@endsection