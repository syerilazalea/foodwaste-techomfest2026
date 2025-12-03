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
                                    @foreach($dataMakanan as $item)
                                    <tr>
                                        <td>
                                            @if($item->gambar)
                                            <img src="{{ asset($item->gambar) }}" class="rounded sw-5 sh-5" alt="Gambar {{ $item->nama }}">
                                            @else
                                            <img src="{{ asset('img/product/small/product-1.webp') }}" class="rounded sw-5 sh-5" alt="No Image">
                                            @endif
                                        </td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->penyedia }}</td>
                                        <td>{{ $item->kategori }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>{{ $item->porsi }} Porsi</td>
                                        <td>{{ $item->batas_waktu }}</td>
                                        <td class="text-nowrap">
                                            <button class="btn btn-sm btn-icon btn-icon-only btn-outline-secondary"
                                                data-bs-toggle="modal" data-bs-target="#modalEdit"
                                                onclick='setEdit(@json($item))'>
                                                <i data-acorn-icon="pen"></i>
                                            </button>

                                            <button class="btn btn-sm btn-icon btn-icon-only btn-outline-danger"
                                                data-bs-toggle="modal" data-bs-target="#modalDelete"
                                                onclick="setDeleteId({{ $item->id }})">
                                                <i data-acorn-icon="bin"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <nav class="mt-3">
                            {{ $dataMakanan->links('pagination::bootstrap-5') }}
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

            <form id="formDelete" action="" method="POST">
                @csrf
                @method('POST') <!-- untuk menghapus data -->
                <input type="hidden" name="id" id="deleteId">
                <div class="modal-footer">
                    <button class="btn btn-outline-primary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" id="btnConfirmDelete">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL INPUT Edit Data Produk Daur Ulang / KOMPOS -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Edit Data Makanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="formEditMakanan" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- untuk update -->

                    <input type="hidden" name="id" id="id">

                    <div class="row mb-4">
                        <div class="col-12">
                            <label class="form-label fw-semibold">Foto Produk Daur Ulang</label>
                            <input type="file" class="form-control" name="gambar" id="edit_gambar" accept="image/*">
                            <img id="preview_edit_gambar" src="" class="mt-2 rounded sw-5 sh-5" style="display:none;">
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nama Makanan</label>
                                <input type="text" class="form-control" name="nama" id="nama" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nama Penyedia / Instansi</label>
                                <input type="text" class="form-control" name="penyedia" id="penyedia" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Alamat</label>
                                <input type="text" class="form-control" name="alamat" id="alamat" value="{{ Auth::user()->alamat }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Kategori Penyedia</label>
                                <div class="d-flex gap-3 flex-wrap">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kategori" id="edit_kategori_umkm" value="UMKM" required>
                                        <label class="form-check-label">UMKM</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kategori" id="edit_kategori_restoran" value="Restoran">
                                        <label class="form-check-label">Restoran</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kategori" id="edit_kategori_hotel" value="Hotel">
                                        <label class="form-check-label">Hotel</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kategori" id="edit_kategori_rumah" value="Rumah Tangga">
                                        <label class="form-check-label">Rumah Tangga</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Porsi</label>
                                <input type="number" class="form-control" name="porsi" id="porsi" min="1" step="1" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Batas Waktu Pengambilan</label>
                                <input type="time" class="form-control" name="batas_waktu" id="edit_batas_waktu" required>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- MODAL INPUT Insert Data Produk Daur Ulang / KOMPOS -->
<div class="modal fade" id="modalInput" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Data Produk Daur Ulang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="formInputMakanan" action="{{ route('dashboard.dataMakanan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Bagian Upload Foto -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <label class="form-label fw-semibold">Foto Makanan</label>
                            <input type="file" class="form-control dropify" name="gambar" id="gambar" accept="image/*">
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nama Item</label>
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Contoh: Ayam Geprek" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nama Penyedia / Instansi</label>
                                <input type="text" class="form-control" name="penyedia" id="penyedia" placeholder="Contoh: RM Sederhana, Hotel Kenanga, Ibu Sari" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Alamat</label>
                                <input type="text" class="form-control" name="alamat" id="alamat" value="{{ Auth::user()->alamat }}" placeholder="Alamat lengkap penyedia" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Kategori Penyedia</label>
                                <div class="d-flex gap-3 flex-wrap">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kategori" value="UMKM" required>
                                        <label class="form-check-label">UMKM</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kategori" value="Restoran">
                                        <label class="form-check-label">Restoran</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kategori" value="Hotel">
                                        <label class="form-check-label">Hotel</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kategori" value="Rumah Tangga">
                                        <label class="form-check-label">Rumah Tangga</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Porsi</label>
                                <input type="number" class="form-control" name="porsi" id="porsi" placeholder="Contoh: 11" min="1" step="1" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Batas Waktu Pengambilan</label>
                                <input type="time" class="form-control" name="batas_waktu" id="batas_waktu" required>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection

@push('scripts')

<script>
    //untuk edit
    function setEdit(data) {
        const form = document.getElementById('formEditMakanan');
        form.action = `/dashboard/data-makanan/${data.id}`; // ini harus sesuai route PUT
        form.querySelector('input[name="id"]').value = data.id;
        form.querySelector('input[name="nama"]').value = data.nama;
        form.querySelector('input[name="penyedia"]').value = data.penyedia;
        form.querySelector('input[name="alamat"]').value = data.alamat;
        form.querySelector('input[name="porsi"]').value = data.porsi;
        form.querySelector('input[name="batas_waktu"]').value = data.batas_waktu;

        const radios = form.querySelectorAll('input[name="kategori"]');
        radios.forEach(radio => radio.checked = (radio.value === data.kategori));

        const imagePreview = form.querySelector('img.image-preview');
        if (data.gambar) {
            imagePreview.src = '/' + data.gambar;
            imagePreview.style.display = 'block';
        } else {
            imagePreview.style.display = 'none';
        }

        const modal = new bootstrap.Modal(document.getElementById('modalEdit'));
        modal.show();
    }

    //untuk delete
    let deleteId = null;

    function setDeleteId(id) {
        deleteId = id;
    }

    document.getElementById('btnConfirmDelete').addEventListener('click', function() {
        if (!deleteId) return;

        const form = document.getElementById('formDelete');
        // update action sesuai route
        form.action = `/dashboard/data-makanan/delete/${deleteId}`;
        form.submit();
    });
</script>

@endpush