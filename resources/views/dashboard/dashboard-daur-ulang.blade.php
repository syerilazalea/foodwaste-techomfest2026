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
        @include('dashboard.components.breadcrumbs')
        <div class="row">
            <div class="col-12">
                <div class="page-title-container">
                </div>
            </div>
        </div>

        <div class="row">
            <section class="scroll-section" id="alwaysResponsive">
                <div class="card m b-5">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0 fw-bold">Daftar Produk Daur Ulang</h5>
                            <div class="d-flex gap-2">
                                <div class="input-group" style="width: 250px;">
                                    <input type="text" id="searchInput" class="form-control" placeholder="Cari daur ulang...">
                                    <button class="btn btn-outline-secondary" type="button">
                                        <i data-acorn-icon="search"></i>
                                    </button>
                                </div>
                                <button class="btn btn-icon btn-icon-end btn-primary mb-1" data-bs-toggle="modal"
                                    data-bs-target="#modalInput" type="button">
                                    <span>Tambahkan Item</span>
                                    <i data-acorn-icon="plus"></i>
                                </button>
                            </div>
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
                                        <th>Berat</th>
                                        <th>Batas Waktu</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <div id="loadingSpinner" class="text-center my-3" style="display: none;">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                                <tbody id="tableBody">
                                    @forelse($dataDaurUlang as $item)
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
                                        <td>{{ $item->berat }} kg</td>
                                        <td>{{ $item->batas_waktu }}</td>
                                        <td class="text-nowrap">
                                            <button class="btn btn-sm btn-icon btn-icon-only btn-outline-secondary btn-edit-produk"
                                                data-produk='@json($item)'>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                    <path d="M12.854.146a.5.5 0 0 1 .646.058l2.292 2.292a.5.5 0 0 1-.058.646L4.207 14.793 1 15l.207-3.207L12.854.146z" />
                                                </svg>
                                            </button>

                                            <button class="btn btn-sm btn-icon btn-icon-only btn-outline-danger"
                                                data-bs-toggle="modal" data-bs-target="#modalDelete"
                                                onclick="setDeleteId({{ $item->id }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 5h4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0V6H6v6.5a.5.5 0 0 1-1 0v-7z" />
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1 0-2h3.5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1H14a1 1 0 0 1 1 1zm-3.5 1V4h-5v-.5h5z" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                    @empty
                                    <!-- EMPTY STATE TABLE -->
                                    <tr>
                                        <td colspan="8">
                                            <div class="d-flex flex-column justify-content-center align-items-center py-5">
                                                <img src="{{ asset('img/page/no-data.svg') }}"
                                                    alt="Tidak ada data"
                                                    class="img-fluid mb-3"
                                                    style="max-height: 120px;">
                                                <p class="text-muted mb-0 text-center">
                                                    Belum ada data daur ulang yang tersedia.
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <nav class="mt-3">
                            {{ $dataDaurUlang->links('pagination::bootstrap-5') }}
                        </nav>
                    </div>
                </div>
                </table>
            </section>
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
                <h5 class="modal-title fw-bold">Edit Data Produk Daur Ulang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="formEditProduk" action="" method="POST" enctype="multipart/form-data">
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
                                <label class="form-label fw-semibold">Nama Item</label>
                                <input type="text" class="form-control" name="nama" id="edit_nama" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nama Penyedia / Instansi</label>
                                <input type="text" class="form-control" name="penyedia" id="edit_penyedia" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Alamat</label>
                                <input type="text" class="form-control" name="alamat" id="edit_alamat" value="{{ Auth::user()->alamat }}" required>
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
                                <label class="form-label fw-semibold">Berat (kg)</label>
                                <input type="number" class="form-control" name="berat" id="edit_berat" min="0.1" step="0.1" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Batas Waktu Pengambilan</label>
                                <input type="dateTime-local" class="form-control" name="batas_waktu" id="edit_batas_waktu" required>
                                <small class="text-danger d-none" id="error-edit-batas-waktu">
                                    Batas waktu tidak boleh kurang dari waktu sekarang.
                                </small>
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
                <form id="formInputProduk" action="{{ route('dashboard.dataDaurUlang.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Bagian Upload Foto -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <label class="form-label fw-semibold">Foto Produk Daur Ulang</label>
                            <input type="file" class="form-control dropify" name="gambar" id="gambar" accept="image/*">
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nama Item</label>
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Contoh: Sisa Sayuran" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nama Penyedia / Instansi</label>
                                <input type="text" class="form-control" name="penyedia" id="penyedia" value="{{ Auth::user()->name }}" placeholder="Contoh: RM Sederhana, Hotel Kenanga, Ibu Sari" required>
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
                                <label class="form-label fw-semibold">Berat (kg)</label>
                                <input type="number" class="form-control" name="berat" id="berat" placeholder="Contoh: 2.4" min="0.1" step="0.1" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Batas Waktu Pengambilan</label>
                                <input type="datetime-local"
                                    class="form-control"
                                    name="batas_waktu"
                                    id="batas_waktu"
                                    required>
                                <small class="text-danger d-none" id="error-batas-waktu">
                                    Batas waktu tidak boleh kurang dari waktu sekarang.
                                </small>
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
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const tableBody = document.getElementById('tableBody');
        const spinner = document.getElementById('loadingSpinner');
        let timeout = null;

        function fetchData(url) {
            spinner.style.display = 'block'; // tampilkan spinner
            fetch(url)
                .then(response => response.text())
                .then(html => {
                    tableBody.innerHTML = html;
                    spinner.style.display = 'none'; // sembunyikan spinner

                    // Re-render icon Acorn
                    if (typeof acorn !== 'undefined' && acorn.icon !== undefined) {
                        acorn.icon.replace();
                    }

                    // Bind klik pagination link
                    document.querySelectorAll('#tableBody .pagination a').forEach(link => {
                        link.addEventListener('click', function(e) {
                            e.preventDefault();
                            fetchData(this.href);
                        });
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                    spinner.style.display = 'none';
                });
        }

        // Event input search
        searchInput.addEventListener('keyup', function() {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                const query = searchInput.value;
                const url = `{{ route('dashboard.dataDaurUlang.search') }}?q=${encodeURIComponent(query)}`;
                fetchData(url);
            }, 300); // delay 300ms agar tidak tiap ketik langsung request
        });

        // Initial bind pagination
        document.querySelectorAll('#tableBody .pagination a').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                fetchData(this.href);
            });
        });
    });
</script>

<script>
    document.getElementById('formInputProduk').addEventListener('submit', function(e) {
        const gambar = document.getElementById('gambar').value;
        const nama = document.getElementById('nama').value.trim();
        const penyedia = document.getElementById('penyedia').value.trim();
        const alamat = document.getElementById('alamat').value.trim();
        const kategori = document.querySelector('input[name="kategori"]:checked');
        const berat = document.getElementById('berat').value.trim();
        const batasWaktu = document.getElementById('batas_waktu').value.trim();

        if (!gambar) {
            e.preventDefault();
            return Swal.fire("Foto wajib diupload!", "", "warning");
        }
        if (nama === "") {
            e.preventDefault();
            return Swal.fire("Nama wajib diisi!", "", "warning");
        }
        if (penyedia === "") {
            e.preventDefault();
            return Swal.fire("Penyedia wajib diisi!", "", "warning");
        }
        if (alamat === "") {
            e.preventDefault();
            return Swal.fire("Alamat wajib diisi!", "", "warning");
        }
        if (!kategori) {
            e.preventDefault();
            return Swal.fire("Kategori wajib dipilih!", "", "warning");
        }
        if (berat === "" || Number(berat) <= 0) {
            e.preventDefault();
            return Swal.fire("Berat minimal 0.1 kg!", "", "warning");
        }
        if (batasWaktu === "") {
            e.preventDefault();
            return Swal.fire("Batas waktu wajib diisi!", "", "warning");
        }
    });
</script>

<script>
    $(document).ready(function() {

    // ======= Inisialisasi Dropify =======
    const initDropify = (selector) => {
        if (!$(selector).hasClass('dropify-initialized')) {
            $(selector).dropify({
                messages: {
                    default: 'Drag or drop your image',
                    replace: 'Drag or drop to replace',
                    remove: 'Remove image',
                    error: 'Oops, invalid file!'
                }
            });
            $(selector).addClass('dropify-initialized');
        }
    };

    // ======= Tombol Edit Produk =======
    $('.btn-edit-produk').on('click', function() {
        const data = $(this).data('produk');

        // Set form action ke route update
        let action = '{{ route("dashboard.dataDaurUlang.update", ":id") }}'.replace(':id', data.id);
        $('#formEditProduk').attr('action', action);

        // Set hidden id
        $('#id').val(data.id);

        // Set input teks
        $('#edit_nama').val(data.nama);
        $('#edit_penyedia').val(data.penyedia);
        $('#edit_alamat').val(data.alamat);
        $('#edit_berat').val(data.berat);
        $('#edit_batas_waktu').val(data.batas_waktu);

        // Set kategori radio
        $(`input[name="kategori"][value="${data.kategori}"]`).prop('checked', true);

        // ======= Dropify gambar =======
        let dr = $('#edit_gambar').data('dropify');
        if (dr) dr.destroy(); // hancurkan Dropify lama
        const defaultFile = data.gambar ? '{{ url("/") }}/' + data.gambar : '';
        $('#edit_gambar').attr('data-default-file', defaultFile);
        initDropify('#edit_gambar');

        // Tampilkan modal
        $('#modalEdit').modal('show');
    });

    // ======= Reset modal saat ditutup =======
    $('#modalEdit').on('hidden.bs.modal', function() {
        $('#formEditProduk')[0].reset();
        let dr = $('#edit_gambar').data('dropify');
        if (dr) dr.resetPreview();
    });

});

</script>

<script>
    //untuk delete
    let deleteId = null;

    function setDeleteId(id) {
        deleteId = id;
    }

    document.getElementById('btnConfirmDelete').addEventListener('click', function() {
        if (!deleteId) return;

        const form = document.getElementById('formDelete');
        // update action sesuai route
        form.action = `/dashboard/data-daur-ulang/delete/${deleteId}`;
        form.submit();
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('batas_waktu');
        const error = document.getElementById('error-batas-waktu');

        function getNowLocal() {
            const now = new Date();
            now.setSeconds(0, 0);
            return now;
        }

        function toDatetimeLocal(date) {
            return date.toISOString().slice(0, 16);
        }

        // Set minimal datetime = sekarang
        input.min = toDatetimeLocal(getNowLocal());

        input.addEventListener('change', function() {
            const selected = new Date(this.value);
            const now = getNowLocal();

            if (selected < now) {
                error.classList.remove('d-none');
                this.value = '';
            } else {
                error.classList.add('d-none');
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('edit_batas_waktu');
        const error = document.getElementById('error-edit-batas-waktu');

        function nowLocal() {
            const now = new Date();
            now.setSeconds(0, 0);
            return now;
        }

        function toDatetimeLocal(date) {
            return date.toISOString().slice(0, 16);
        }

        function setMinDatetime() {
            input.min = toDatetimeLocal(nowLocal());
        }

        setMinDatetime();

        input.addEventListener('change', function() {
            const selected = new Date(this.value);
            const now = nowLocal();

            if (selected < now) {
                error.classList.remove('d-none');
                this.value = '';
            } else {
                error.classList.add('d-none');
            }
        });
    });
</script>
@endpush