@extends('dashboard.layouts.app')

@push('style')

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
                    <div class="col mb-5">
                        <div class="card shadow-sm" style="border-radius: 14px; overflow: hidden;" data-bs-toggle="modal" data-bs-target="#modalDetail1">
                            <img src="{{asset ('img/product/small/product-1.webp')}}" class="card-img-top" style="height: 160px; object-fit: cover;" alt="card image" />

                            <div class="card-body p-3">
                                <h5 class="heading mb-3">
                                    <a href="#" class="body-link stretched-link">Sisa Makanan</a>
                                </h5>
                                <div class="d-flex align-items-center text-muted small mb-2" style="gap: 16px;">
                                    <div class="d-flex align-items-center">
                                        <i data-acorn-icon="user" class="me-1"></i>
                                        <span class="text-primary">35 Porsi</span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i data-acorn-icon="clock" class="me-1"></i>
                                        <span class="text-primary">14:00 WIB</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5">
                        <div class="card shadow-sm" style="border-radius: 14px; overflow: hidden;" data-bs-toggle="modal" data-bs-target="#modalDetail1">
                            <img src="{{asset ('img/product/small/product-1.webp')}}" class="card-img-top" style="height: 160px; object-fit: cover;" alt="card image" />

                            <div class="card-body p-3">
                                <h5 class="heading mb-3">
                                    <a href="#" class="body-link stretched-link">Sisa Makanan</a>
                                </h5>
                                <div class="d-flex align-items-center text-muted small mb-2" style="gap: 16px;">
                                    <div class="d-flex align-items-center">
                                        <i data-acorn-icon="user" class="me-1"></i>
                                        <span class="text-primary">35 Porsi</span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i data-acorn-icon="clock" class="me-1"></i>
                                        <span class="text-primary">14:00 WIB</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5">
                        <div class="card shadow-sm" style="border-radius: 14px; overflow: hidden;" data-bs-toggle="modal" data-bs-target="#modalDetail1">
                            <img src="{{asset ('img/product/small/product-1.webp')}}" class="card-img-top" style="height: 160px; object-fit: cover;" alt="card image" />

                            <div class="card-body p-3">
                                <h5 class="heading mb-3">
                                    <a href="#" class="body-link stretched-link">Sisa Makanan</a>
                                </h5>
                                <div class="d-flex align-items-center text-muted small mb-2" style="gap: 16px;">
                                    <div class="d-flex align-items-center">
                                        <i data-acorn-icon="user" class="me-1"></i>
                                        <span class="text-primary">35 Porsi</span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i data-acorn-icon="clock" class="me-1"></i>
                                        <span class="text-primary">14:00 WIB</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5">
                        <div class="card shadow-sm" style="border-radius: 14px; overflow: hidden;" data-bs-toggle="modal" data-bs-target="#modalDetail1">
                            <img src="{{asset ('img/product/small/product-1.webp')}}" class="card-img-top" style="height: 160px; object-fit: cover;" alt="card image" />

                            <div class="card-body p-3">
                                <h5 class="heading mb-3">
                                    <a href="#" class="body-link stretched-link">Sisa Makanan</a>
                                </h5>
                                <div class="d-flex align-items-center text-muted small mb-2" style="gap: 16px;">
                                    <div class="d-flex align-items-center">
                                        <i data-acorn-icon="user" class="me-1"></i>
                                        <span class="text-primary">35 Porsi</span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i data-acorn-icon="clock" class="me-1"></i>
                                        <span class="text-primary">14:00 WIB</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5">
                        <div class="card shadow-sm" style="border-radius: 14px; overflow: hidden;" data-bs-toggle="modal" data-bs-target="#modalDetail1">
                            <img src="{{asset ('img/product/small/product-1.webp')}}" class="card-img-top" style="height: 160px; object-fit: cover;" alt="card image" />

                            <div class="card-body p-3">
                                <h5 class="heading mb-3">
                                    <a href="#" class="body-link stretched-link">Sisa Makanan</a>
                                </h5>
                                <div class="d-flex align-items-center text-muted small mb-2" style="gap: 16px;">
                                    <div class="d-flex align-items-center">
                                        <i data-acorn-icon="user" class="me-1"></i>
                                        <span class="text-primary">35 Porsi</span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i data-acorn-icon="clock" class="me-1"></i>
                                        <span class="text-primary">14:00 WIB</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5">
                        <div class="card shadow-sm" style="border-radius: 14px; overflow: hidden;" data-bs-toggle="modal" data-bs-target="#modalDetail1">
                            <img src="{{asset ('img/product/small/product-1.webp')}}" class="card-img-top" style="height: 160px; object-fit: cover;" alt="card image" />

                            <div class="card-body p-3">
                                <h5 class="heading mb-3">
                                    <a href="#" class="body-link stretched-link">Sisa Makanan</a>
                                </h5>
                                <div class="d-flex align-items-center text-muted small mb-2" style="gap: 16px;">
                                    <div class="d-flex align-items-center">
                                        <i data-acorn-icon="user" class="me-1"></i>
                                        <span class="text-primary">35 Porsi</span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i data-acorn-icon="clock" class="me-1"></i>
                                        <span class="text-primary">14:00 WIB</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5">
                        <div class="card shadow-sm" style="border-radius: 14px; overflow: hidden;" data-bs-toggle="modal" data-bs-target="#modalDetail1">
                            <img src="{{asset ('img/product/small/product-1.webp')}}" class="card-img-top" style="height: 160px; object-fit: cover;" alt="card image" />

                            <div class="card-body p-3">
                                <h5 class="heading mb-3">
                                    <a href="#" class="body-link stretched-link">Sisa Makanan</a>
                                </h5>
                                <div class="d-flex align-items-center text-muted small mb-2" style="gap: 16px;">
                                    <div class="d-flex align-items-center">
                                        <i data-acorn-icon="user" class="me-1"></i>
                                        <span class="text-primary">35 Porsi</span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i data-acorn-icon="clock" class="me-1"></i>
                                        <span class="text-primary">14:00 WIB</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5">
                        <div class="card shadow-sm" style="border-radius: 14px; overflow: hidden;" data-bs-toggle="modal" data-bs-target="#modalDetail1">
                            <img src="{{asset ('img/product/small/product-1.webp')}}" class="card-img-top" style="height: 160px; object-fit: cover;" alt="card image" />

                            <div class="card-body p-3">
                                <h5 class="heading mb-3">
                                    <a href="#" class="body-link stretched-link">Sisa Makanan</a>
                                </h5>
                                <div class="d-flex align-items-center text-muted small mb-2" style="gap: 16px;">
                                    <div class="d-flex align-items-center">
                                        <i data-acorn-icon="user" class="me-1"></i>
                                        <span class="text-primary">35 Porsi</span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i data-acorn-icon="clock" class="me-1"></i>
                                        <span class="text-primary">14:00 WIB</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    </div>
    </div>
</main>

<div class="modal fade" id="modalDetail1" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Detail Makanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <!-- Nama -->
                <h5 class="mb-3 fw-bold">Nasi Kotak</h5>

                <!-- Info utama -->
                <div class="mb-3">
                    <div><strong>Jumlah Tersedia:</strong> 35 Porsi</div>
                    <div><strong>Batas Pengambilan:</strong> 14:00 WIB</div>
                </div>

                <!-- Info penyedia -->
                <div class="border rounded p-3 bg-light mb-3">
                    <div><strong>Penyedia:</strong> RM Sederhana</div>
                    <div><strong>Jenis:</strong> Restoran</div>
                    <div><strong>Alamat:</strong> Jl. Kenanga No. 12</div>
                </div>

                <!-- Input jumlah yang ingin diambil -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Jumlah yang Ingin Diambil</label>
                    <input type="number" id="ambilJumlah1" class="form-control" min="1" placeholder="Masukkan jumlah..." />
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="konfirmasiPickup(1)">Konfirmasi
                    Pengambilan</button>
            </div>

        </div>
    </div>
</div>

<!-- Search Modal Start -->
<div class="modal fade modal-under-nav modal-search modal-close-out" id="searchPagesModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0 p-0">
                <button type="button" class="btn-close btn btn-icon btn-icon-only btn-foreground" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ps-5 pe-5 pb-0 border-0">
                <input id="searchPagesInput" class="form-control form-control-xl borderless ps-0 pe-0 mb-1 auto-complete" type="text" autocomplete="off" />
            </div>
            <div class="modal-footer border-top justify-content-start ps-5 pe-5 pb-3 pt-3 border-0">
                <span class="text-alternate d-inline-block m-0 me-3">
                    <i data-acorn-icon="arrow-bottom" data-acorn-size="15"
                        class="text-alternate align-middle me-1"></i>
                    <span class="align-middle text-medium">Navigate</span>
                </span>
                <span class="text-alternate d-inline-block m-0 me-3">
                    <i data-acorn-icon="arrow-bottom-left" data-acorn-size="15"
                        class="text-alternate align-middle me-1"></i>
                    <span class="align-middle text-medium">Select</span>
                </span>
            </div>
        </div>
    </div>
</div>
<!-- Search Modal End -->

@endsection

@push('script')

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

@endpush