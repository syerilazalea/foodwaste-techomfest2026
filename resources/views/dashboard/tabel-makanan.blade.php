@extends('dashboard.layouts.app')

@section('content')

@push('style')

<!-- styles input form -->
<style>
    .table-scroll {
        max-height: 400px;
        overflow-y: auto;
        display: block;
    }
</style>

@endpush

<main>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title-container">
                    <h1 class="mb-0 pb-0 display-4" id="title">Tabel Data Makanan</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <section class="scroll-section" id="alwaysResponsive">
                <div class="card mb-5">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0 fw-bold">Daftar Makanan</h5>
                            <button class="btn btn-icon btn-icon-end btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#modalInput" type="button">
                                <span>Tambahkan Item</span>
                                <i data-acorn-icon="plus"></i>
                            </button>
                        </div>

                        <div class="table-responsive table-scroll">
                            <table class="table align-middle" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Nama Item</th>
                                        <th>Nama Penyedia</th>
                                        <th>Kategori Penyedia</th>
                                        <th>Alamat</th>
                                        <th>Porsi</th>
                                        <th>Batas Waktu</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody id="tableBody">
                                    <tr>
                                        <td>
                                            <img src="{{asset ('img/product/small/product-1.webp')}}" class="rounded sw-5 sh-5">
                                        </td>
                                        <td>Nasi Kotak</td>
                                        <td>RM Sederhana</td>
                                        <td>Restoran</td>
                                        <td>Jl. Kenanga No. 12</td>
                                        <td>35</td>
                                        <td>14:00 WIB</td>
                                        <td class="text-nowrap">
                                            <button class="btn btn-sm btn-icon btn-icon-only btn-outline-secondary me-1" data-bs-toggle="modal" data-bs-target="#modalInput" onclick="setEdit(1)">
                                                <i data-acorn-icon="pen"></i>
                                            </button>
                                            <button class="btn btn-sm btn-icon btn-icon-only btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDelete" onclick="setDeleteId(1)">
                                                <i data-acorn-icon="bin"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="{{asset ('img/product/small/product-1.webp')}}" class="rounded sw-5 sh-5">
                                        </td>
                                        <td>Nasi Kotak</td>
                                        <td>RM Sederhana</td>
                                        <td>Restoran</td>
                                        <td>Jl. Kenanga No. 12</td>
                                        <td>35</td>
                                        <td>14:00 WIB</td>
                                        <td class="text-nowrap">
                                            <button class="btn btn-sm btn-icon btn-icon-only btn-outline-secondary me-1" data-bs-toggle="modal" data-bs-target="#modalInput" onclick="setEdit(1)">
                                                <i data-acorn-icon="pen"></i>
                                            </button>
                                            <button class="btn btn-sm btn-icon btn-icon-only btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDelete" onclick="setDeleteId(1)">
                                                <i data-acorn-icon="bin"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="{{asset ('img/product/small/product-1.webp')}}" class="rounded sw-5 sh-5">
                                        </td>
                                        <td>Nasi Kotak</td>
                                        <td>RM Sederhana</td>
                                        <td>Restoran</td>
                                        <td>Jl. Kenanga No. 12</td>
                                        <td>35</td>
                                        <td>14:00 WIB</td>
                                        <td class="text-nowrap">
                                            <button class="btn btn-sm btn-icon btn-icon-only btn-outline-secondary me-1" data-bs-toggle="modal" data-bs-target="#modalInput" onclick="setEdit(1)">
                                                <i data-acorn-icon="pen"></i>
                                            </button>
                                            <button class="btn btn-sm btn-icon btn-icon-only btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDelete" onclick="setDeleteId(1)">
                                                <i data-acorn-icon="bin"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="{{asset ('img/product/small/product-1.webp')}}" class="rounded sw-5 sh-5">
                                        </td>
                                        <td>Nasi Kotak</td>
                                        <td>RM Sederhana</td>
                                        <td>Restoran</td>
                                        <td>Jl. Kenanga No. 12</td>
                                        <td>35</td>
                                        <td>14:00 WIB</td>
                                        <td class="text-nowrap">
                                            <button class="btn btn-sm btn-icon btn-icon-only btn-outline-secondary me-1" data-bs-toggle="modal" data-bs-target="#modalInput" onclick="setEdit(1)">
                                                <i data-acorn-icon="pen"></i>
                                            </button>
                                            <button class="btn btn-sm btn-icon btn-icon-only btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDelete" onclick="setDeleteId(1)">
                                                <i data-acorn-icon="bin"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="{{asset ('img/product/small/product-1.webp')}}" class="rounded sw-5 sh-5">
                                        </td>
                                        <td>Nasi Kotak</td>
                                        <td>RM Sederhana</td>
                                        <td>Restoran</td>
                                        <td>Jl. Kenanga No. 12</td>
                                        <td>35</td>
                                        <td>14:00 WIB</td>
                                        <td class="text-nowrap">
                                            <button class="btn btn-sm btn-icon btn-icon-only btn-outline-secondary me-1" data-bs-toggle="modal" data-bs-target="#modalInput" onclick="setEdit(1)">
                                                <i data-acorn-icon="pen"></i>
                                            </button>
                                            <button class="btn btn-sm btn-icon btn-icon-only btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDelete" onclick="setDeleteId(1)">
                                                <i data-acorn-icon="bin"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="{{asset ('img/product/small/product-1.webp')}}" class="rounded sw-5 sh-5">
                                        </td>
                                        <td>Nasi Kotak</td>
                                        <td>RM Sederhana</td>
                                        <td>Restoran</td>
                                        <td>Jl. Kenanga No. 12</td>
                                        <td>35</td>
                                        <td>14:00 WIB</td>
                                        <td class="text-nowrap">
                                            <button class="btn btn-sm btn-icon btn-icon-only btn-outline-secondary me-1" data-bs-toggle="modal" data-bs-target="#modalInput" onclick="setEdit(1)">
                                                <i data-acorn-icon="pen"></i>
                                            </button>
                                            <button class="btn btn-sm btn-icon btn-icon-only btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDelete" onclick="setDeleteId(1)">
                                                <i data-acorn-icon="bin"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="{{asset ('img/product/small/product-1.webp')}}" class="rounded sw-5 sh-5">
                                        </td>
                                        <td>Nasi Kotak</td>
                                        <td>RM Sederhana</td>
                                        <td>Restoran</td>
                                        <td>Jl. Kenanga No. 12</td>
                                        <td>35</td>
                                        <td>14:00 WIB</td>
                                        <td class="text-nowrap">
                                            <button class="btn btn-sm btn-icon btn-icon-only btn-outline-secondary me-1" data-bs-toggle="modal" data-bs-target="#modalInput" onclick="setEdit(1)">
                                                <i data-acorn-icon="pen"></i>
                                            </button>
                                            <button class="btn btn-sm btn-icon btn-icon-only btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDelete" onclick="setDeleteId(1)">
                                                <i data-acorn-icon="bin"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="{{asset ('img/product/small/product-1.webp')}}" class="rounded sw-5 sh-5">
                                        </td>
                                        <td>Nasi Kotak</td>
                                        <td>RM Sederhana</td>
                                        <td>Restoran</td>
                                        <td>Jl. Kenanga No. 12</td>
                                        <td>35</td>
                                        <td>14:00 WIB</td>
                                        <td class="text-nowrap">
                                            <button class="btn btn-sm btn-icon btn-icon-only btn-outline-secondary me-1" data-bs-toggle="modal" data-bs-target="#modalInput" onclick="setEdit(1)">
                                                <i data-acorn-icon="pen"></i>
                                            </button>
                                            <button class="btn btn-sm btn-icon btn-icon-only btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDelete" onclick="setDeleteId(1)">
                                                <i data-acorn-icon="bin"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="{{asset ('img/product/small/product-1.webp')}}" class="rounded sw-5 sh-5">
                                        </td>
                                        <td>Nasi Kotak</td>
                                        <td>RM Sederhana</td>
                                        <td>Restoran</td>
                                        <td>Jl. Kenanga No. 12</td>
                                        <td>35</td>
                                        <td>14:00 WIB</td>
                                        <td class="text-nowrap">
                                            <button class="btn btn-sm btn-icon btn-icon-only btn-outline-secondary me-1" data-bs-toggle="modal" data-bs-target="#modalInput" onclick="setEdit(1)">
                                                <i data-acorn-icon="pen"></i>
                                            </button>
                                            <button class="btn btn-sm btn-icon btn-icon-only btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDelete" onclicak="setDeleteId(1)">
                                                <i data-acorn-icon="bin"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <nav class="mt-3">
                            <ul class="pagination justify-content-end">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                        <i data-acorn-icon="chevron-left"></i>
                                    </a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">
                                        <i data-acorn-icon="chevron-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                </table>
        </div>
    </div>
    </section>
    </div>
    </div>
    </div>
    </div>
</main>

<!-- Modal Delete -->
<div class="modal fade" id="modalDelete" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">

            <div class="modal-header">
                <h5 class="modal-title fw-bold">Hapus Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center py-4">
                <i data-acorn-icon="bin" data-acorn-size="40" class="text-danger mb-3"></i>
                <h6 class="fw-semibold">Apakah Anda yakin ingin menghapus data ini?</h6>
                <p class="text-muted mb-0">Tindakan ini tidak dapat dibatalkan.</p>
            </div>

            <div class="modal-footer">
                <button class="btn btn-outline-primary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-primary" id="btnConfirmDelete">Hapus</button>
            </div>

        </div>
    </div>
</div>


<!-- MODAL INPUT DATA MAKANAN / KOMPOS -->
<div class="modal fade" id="modalInput" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Data Makanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="formInputMakanan">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nama Item</label>
                                <input type="text" class="form-control" placeholder="Contoh: Nasi Kotak" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nama Penyedia / Instansi</label>
                                <input type="text" class="form-control" placeholder="Contoh: RM Sederhana, Hotel Kenanga, Ibu Sari" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Alamat</label>
                                <input type="text" class="form-control" placeholder="Alamat lengkap penyedia" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Kategori Penyedia</label>
                                <div class="d-flex gap-3 flex-wrap">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="penyedia" value="UMKM" required>
                                        <label class="form-check-label">UMKM</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="penyedia" value="Restoran">
                                        <label class="form-check-label">Restoran</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="penyedia" value="Hotel">
                                        <label class="form-check-label">Hotel</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="penyedia" value="Rumah Tangga">
                                        <label class="form-check-label">Rumah Tangga</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Jumlah Porsi</label>
                                <input type="number" class="form-control" placeholder="Contoh: 35" min="1" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Batas Waktu Pengambilan</label>
                                <input type="time" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-primary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-primary" data-bs-dismiss>Simpan</button>
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

@push('script')

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

@endpush

@endsection