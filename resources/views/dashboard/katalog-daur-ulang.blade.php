@extends('dashboard.layouts.app')

@push('styles')

<style>
    .table-scroll {
        max-height: 400px;
        overflow-y: auto;
        display: block;
    }

    .active-kategori {
        border: 3px solid #4caf50 !important;
        transform: scale(0.98);
        transition: 0.2s;
    }
</style>

@endpush

@section('content')

<main>
    <div class="container">
        @include('dashboard.components.breadcrumbs')
        <div class="row">
            <!-- LEFT CONTENT -->
            <div class="col-12 col-xl-8 col-xxl-9 mb-5" id="daurUlangContainer">

                <div id="daurUlangList" class="row row-cols-1 row-cols-sm-2 row-cols-xl-3 g-3">

                    @foreach($daurUlang as $data)
                    @include('dashboard.partials.katalog-daurUlang-card', ['data' => $data])
                    @endforeach

                </div>
                <div class="row mt-5">
                    <div class="col-12 text-center">
                        <button id="loadMoreBtn" class="btn btn-xl btn-outline-primary sw-30" data-skip="6" @if($totalDaurUlang <=6) style="display:none" @endif>Lebih Banyak</button>
                    </div>
                </div>
            </div>

            @php
            $categories = ['semua', 'restoran', 'rumah tangga', 'umkm', 'hotel'];
            @endphp
            <!-- RIGHT SIDEBAR -->
            <div class="col-12 col-xl-4 col-xxl-3">
                <section class="scroll-section" id="imagesHorizontal">

                    <h2 class="small-title">Kategori</h2>
                    <div class="row g-3">
                        @foreach($categories as $cat)
                        <div class="col-12" style="cursor:pointer;">
                            <div class="card w-100 sh-12 hover-img-scale-up kategori-btn"
                                data-kategori="{{ $cat }}"
                                style="border-radius:10px; overflow:hidden;">

                                <!-- Ganti gambar sesuai kategori -->
                                @php
                                // opsional: bisa pakai switch untuk gambar spesifik kategori
                                $imgPath = match(strtolower($cat)) {
                                'semua' => 'img/kategori/Group 1.jpg',
                                'restoran' => 'img/kategori/Group 4.jpg',
                                'rumah tangga' => 'img/kategori/Group 2.jpg',
                                'umkm' => 'img/kategori/Group 5.jpg',
                                'hotel' => 'img/kategori/Group 3.jpg'
                                };
                                @endphp

                                <img src="{{ asset($imgPath) }}" class="card-img h-100 scale" alt="card image" />

                                <div class="card-img-overlay d-flex flex-column justify-content-center bg-transparent p-2 mx-5">
                                    <div class="cta-5 text-black w-75 w-md-50">{{ ucfirst($cat) }}</div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>
            </div>
        </div>
    </div>
</main>

@foreach($daurUlang as $data)
<div class="modal fade" id="modalDetail{{ $data->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form action="{{ route('katalog.katalaogDaurUlang.ambil', $data->id) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Detail Daur Ulang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <!-- Nama -->
                    <h5 class="mb-3 fw-bold">{{ $data->nama }}</h5>

                    <!-- Info utama -->
                    <div class="mb-3">
                        <div><strong>Jumlah Tersedia:</strong> {{ $data->berat }} kg</div>
                        <div><strong>Batas Pengambilan:</strong> {{ \Carbon\Carbon::parse($data->batas_waktu)->format('H:i') }} WIB</div>
                    </div>

                    <!-- Info penyedia -->
                    <div class="border rounded p-3 bg-light mb-3">
                        <div><strong>Penyedia:</strong> {{ $data->penyedia }}</div>
                        <div><strong>Jenis:</strong> {{ $data->kategori }}</div>
                        <div><strong>Alamat:</strong> {{ $data->alamat }}</div>
                    </div>

                    <!-- Input jumlah yang ingin diambil -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Jumlah yang Ingin Diambil</label>
                        <input type="number" name="jumlah" id="ambilJumlah{{ $data->id }}" pattern="[0-9]+([,\.][0-9]+)?" class="form-control" min="0" step="0.1" placeholder="Masukkan jumlah..." />
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                    @auth
                    {{-- Jika user login --}}
                    <button type="submit" class="btn btn-primary" onclick="handleKonfirmasi({{ $data->id }})">
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

<!-- script input form -->
<script>
    const radioJenis = document.querySelectorAll('input[name="jenis"]');
    const fieldMakanan = document.getElementById("fieldMakanan");
    const fieldKompos = document.getElementById("fieldKompos");

    radioJenis.forEach(radio => {
        radio.addEventListener("change", function() {
            if (this.value === "makanan") {
                fieldMakanan.classList.remove("d-none");
                fieldKompos.classList.add("d-none");
            } else {
                fieldMakanan.classList.add("d-none");
                fieldKompos.classList.remove("d-none");
            }
        });
    });
</script>

<script>
    document.addEventListener('click', function(e) {
        const a = e.target.closest('a[href="#"]');
        if (a) e.preventDefault();
    });
</script>

<script>
    let kategori = "semua";
    let offset = 6;

    // Filter kategori
    $(document).on("click", ".kategori-btn", function() {
        kategori = $(this).data("kategori");
        offset = 0;

        $(".kategori-btn").removeClass("active-kategori");
        $(this).addClass("active-kategori");

        $.ajax({
            url: "{{ route('katalog.katalogDaurUlang.filter') }}",
            method: "GET",
            data: {
                kategori,
                offset
            },
            success: function(res) {

                // Replace isi LIST saja
                $("#daurUlangList").html(res.html);

                offset = 6;

                if (res.count < 6) {
                    $("#loadMoreBtn").hide();
                } else {
                    $("#loadMoreBtn").show();
                }
            }
        });
    });

    // Load More
    $(document).on("click", "#loadMoreBtn", function() {
        $.ajax({
            url: "{{ route('katalog.katalogDaurUlang.filter') }}",
            method: "GET",
            data: {
                kategori,
                offset
            },
            success: function(res) {

                // Append hanya ke LIST
                $("#daurUlangList").append(res.html);

                offset += 6;

                if (res.count < 6) {
                    $("#loadMoreBtn").hide();
                }
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(e) {
                @guest
                e.preventDefault(); // cegah submit jika belum login
                window.location.href = "{{ route('auth.login') }}";
                @endguest
                // Jika login, form tetap submit normal
            });
        });
    });
</script>

@endpush