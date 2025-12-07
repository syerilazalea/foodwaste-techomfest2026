@php
    $breadcrumbs = generateBreadcrumbs();
@endphp

<div class="page-title-container">
    {{-- TITLE otomatis (ambil segmen terakhir yang bukan ID) --}}
    <h1 class="mb-0 pb-0 display-4" id="title">
        {{ end($breadcrumbs)['name'] ?? 'Home' }}
    </h1>

    {{-- Breadcrumb --}}
    <nav class="breadcrumb-container d-inline-block" aria-label="breadcrumb">
        <ul class="breadcrumb pt-0">

            {{-- HOME dengan icon --}}
            <li class="breadcrumb-item">
                <a href="{{ url('/') }}">
                    <i data-acorn-icon="home" class="me-1"></i>
                </a>
            </li>

            {{-- Breadcrumb lainnya --}}
            @foreach ($breadcrumbs as $crumb)
                @if ($loop->last)
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $crumb['name'] }}
                    </li>
                @else
                    <li class="breadcrumb-item">
                        <a href="{{ url($crumb['url']) }}">{{ $crumb['name'] }}</a>
                    </li>
                @endif
            @endforeach

        </ul>
    </nav>
</div>
