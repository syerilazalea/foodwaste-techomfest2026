@extends('dashboard.layouts.app')

@push('styles')

<style>
    .table-scroll {
        max-height: 400px;
        overflow-y: auto;
        display: block;
    }
</style>

@endpush

@section('content')

<main>
    <div class="container">
        <div class="row">
            <section class="scroll-section" id="basicItems">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4">
                    @foreach($makanan as $data)
                    <div class="col mb-5">
                        <div class="card shadow-sm" style="border-radius: 14px; overflow: hidden;" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $data->id }}">
                            <img src="{{ $data->gambar ? asset($data->gambar) : asset('img/default.png') }}"
                                class="card-img-top" style="height: 160px; object-fit: cover;" alt="{{ $data->nama }}" />
                            <div class="card-body p-3">
                                <h5 class="heading mb-3">
                                    <a href="#" class="body-link stretched-link">{{ $data->nama }}</a>
                                </h5>
                                <div class="d-flex align-items-center text-muted small mb-2" style="gap: 16px;">
                                    <div class="d-flex align-items-center">
                                        <i data-acorn-icon="user" class="me-1"></i>
                                        <span class="text-primary">{{ $data->porsi }} Porsi</span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i data-acorn-icon="clock" class="me-1"></i>
                                        <span class="text-primary">{{ \Carbon\Carbon::parse($data->batas_waktu)->format('H:i') }} WIB</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
    </div>
    </div>
</main>

@foreach($makanan as $data)
<div class="modal fade" id="modalDetail{{ $data->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form action="{{ route('katalog.katalogMakanan.ambil', $data->id) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Detail Makanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <!-- Nama -->
                    <h5 class="mb-3 fw-bold">{{ $data->nama }}</h5>

                    <!-- Info utama -->
                    <div class="mb-3">
                        <div><strong>Jumlah Tersedia:</strong> {{ $data->porsi }} Porsi</div>
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
                        <input type="number" name="jumlah" id="ambilJumlah{{ $data->id }}" class="form-control" min="1" placeholder="Masukkan jumlah..." />
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" onclick="handleKonfirmasi({{ $data->id }})">Konfirmasi
                        Pengambilan</button>
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