@extends('dashboard.layouts.app')

@push('styles')

<style>
    .table-scroll {
        max-height: 600px;
        overflow-y: auto;
        display: block;
    }

    .badge.bg-outline-primary {
        background-color: transparent;
        border: 1px solid var(--bs-primary);
        color: var(--bs-primary);
    }

    .badge.bg-outline-info {
        background-color: transparent;
        border: 1px solid var(--bs-info);
        color: var(--bs-info);
    }

    .badge.bg-outline-success {
        background-color: transparent;
        border: 1px solid var(--bs-success);
        color: var(--bs-success);
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
                    <p class="mb-0 text-muted">Kelola semua artikel edukasi lingkungan</p>
                </div>
            </div>
        </div>

        <!-- Tabel Artikel -->
        <div class="row">
            <section class="scroll-section" id="alwaysResponsive">
                <div class="card mb-5">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0 fw-bold">Daftar Artikel</h5>
                            <div class="d-flex gap-2">
                                <div class="input-group" style="width: 250px;">
                                    <input type="text" id="searchInput" class="form-control" placeholder="Cari agenda...">
                                    <button class="btn btn-outline-secondary" type="button">
                                        <i data-acorn-icon="search"></i>
                                    </button>
                                </div>
                                <!-- Select Status Filter -->
                                <select id="filterStatus" class="form-select" style="width: 150px;">
                                    <option value="">Semua Status</option>
                                    <option value="Published">Published</option>
                                    <option value="Draft">Draft</option>
                                </select>
                                <button class="btn btn-primary d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#buatArtikel">
                                    <i data-acorn-icon="plus"></i>
                                    <span>Buat Artikel</span>
                                </button>
                            </div>
                        </div>

                        <div class="table-responsive table-scroll">
                            @php
                            $userArtikels = $artikels->where('user_id', auth()->id());
                            @endphp

                            @if($userArtikels->isEmpty())
                            <div class="d-flex flex-column justify-content-center align-items-center" style="min-height: 250px;">
                                <img src="{{ asset('img/page/no-data.svg') }}" alt="Tidak ada agenda" class="img-fluid mb-3" style="max-height: 150px;">
                                <p class="text-center text-muted mb-0">Belum ada data artikel.</p>
                            </div>
                            @else
                            <table class="table align-middle" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>Gambar</th>
                                        <th>Judul Artikel</th>
                                        <th>Kategori</th>
                                        <th>Status</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <div id="loadingSpinner" class="text-center my-3" style="display: none;">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                                <tbody id="artikelTableBody">
                                    @foreach($artikels as $artikel)
                                    <tr>
                                        <td>
                                            @if($artikel->gambar && file_exists(public_path($artikel->gambar)))
                                            <img src="{{ asset($artikel->gambar) }}" class="rounded sw-8 sh-8">
                                            @else
                                            <span class="text-muted">Tidak ada gambar</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="fw-bold">{{ $artikel->judul }}</div>
                                            <div class="text-muted small">{{ Str::limit(strip_tags($artikel->deskripsi), 80) }}</div>
                                        </td>
                                        <td>
                                            <span class="badge bg-outline-primary">{{ ucfirst($artikel->kategori) }}</span>
                                        </td>
                                        <td>
                                            @if($artikel->status == 'Published')
                                            <span class="badge bg-success">{{ $artikel->status }}</span>
                                            @else
                                            <span class="badge bg-secondary">{{ $artikel->status }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $artikel->created_at->translatedFormat('d M Y') }}</td>
                                        <td class="text-nowrap">
                                            <button class="btn btn-sm btn-icon btn-icon-only btn-outline-secondary me-1 btn-edit-artikel"
                                                data-artikel='@json($artikel)'>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                    <path d="M12.854.146a.5.5 0 0 1 .646.058l2.292 2.292a.5.5 0 0 1-.058.646L4.207 14.793 1 15l.207-3.207L12.854.146z" />
                                                </svg>
                                            </button>
                                            <button class="btn btn-sm btn-icon btn-icon-only btn-outline-danger btnDelete"
                                                data-slug="{{ $artikel->slug }}"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalDelete">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 5h4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0V6H6v6.5a.5.5 0 0 1-1 0v-7z" />
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1 0-2h3.5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1H14a1 1 0 0 1 1 1zm-3.5 1V4h-5v-.5h5z" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                        </div>

                        <!-- Pagination -->
                        <nav class="mt-3">
                            <div class="d-flex justify-content-end mt-3">
                                <div class="d-flex justify-content-end mt-3">
                                    {{ $artikels->links('vendor.pagination.bootstrap-5') }}
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>

<!-- Modal Edit Artikel -->
<!-- Modal Edit Makanan -->
<div class="modal fade" id="modalEditMakanan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form id="formEditMakanan" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Edit Data Makanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <!-- Hidden ID -->
                    <input type="hidden" name="id" id="edit_id">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Foto Produk Daur Ulang</label>
                        <input type="file" class="form-control dropify-edit" name="gambar" id="edit_gambar" accept="image/*">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Makanan</label>
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

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kategori Penyedia</label>
                        <select class="form-select" name="kategori" id="edit_kategori" required>
                            <option value="UMKM">UMKM</option>
                            <option value="Restoran">Restoran</option>
                            <option value="Hotel">Hotel</option>
                            <option value="Rumah Tangga">Rumah Tangga</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Porsi</label>
                        <input type="number" class="form-control" name="porsi" id="edit_porsi" min="1" step="1" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Batas Waktu Pengambilan</label>
                        <input type="datetime-local" class="form-control" name="batas_waktu" id="edit_batas_waktu" required>
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
<!-- Modal Buat Artikel -->
<div class="modal fade" id="buatArtikel" tabindex="-1" aria-labelledby="buatArtikelLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('dashboard.artikel.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="buatArtikelLabel">Buat Artikel Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Judul Artikel</label>
                        <input type="text" name="judul" class="form-control" placeholder="Masukkan judul artikel" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Konten Artikel</label>
                        <textarea name="deskripsi" id="editor-create" class="form-control" rows="6" placeholder="Tulis konten artikel di sini..." reuired></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gambar</label>
                        <input type="file" class="form-control dropify" name="gambar" id="gambar" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="kategori" class="form-select" required>
                            <option value="">Pilih kategori</option>
                            <option value="education">Edukasi</option>
                            <option value="tips">Tips & Trik</option>
                            <option value="news">Berita</option>
                            <option value="tutorial">Tutorial</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="draft" value="Draft" checked>
                                <label class="form-check-label" for="draft">Draft</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="publish" value="Published">
                                <label class="form-check-label" for="publish">Publish</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Artikel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="modalDelete" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Hapus Agenda</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center py-4">
                <i data-acorn-icon="bin" data-acorn-size="40" class="text-danger mb-3"></i>
                <h6 class="fw-semibold">Apakah Anda yakin ingin menghapus ini?</h6>
                <p class="text-muted mb-0">Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-primary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-primary">Hapus</button>
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
        const filterStatus = document.getElementById('filterStatus');
        const tableBody = document.getElementById('artikelTableBody');
        const spinner = document.getElementById('loadingSpinner');
        let timeout = null;

        function fetchData() {
            const status = filterStatus.value;
            const keyword = searchInput.value;
            const url = `{{ route('dashboard.artikel.search') }}?status=${encodeURIComponent(status)}&q=${encodeURIComponent(keyword)}`;

            if (spinner) spinner.style.display = 'block';

            fetch(url)
                .then(response => response.text())
                .then(html => {
                    tableBody.innerHTML = html;
                    if (spinner) spinner.style.display = 'none';

                    // Bind pagination
                    document.querySelectorAll('#artikelTableBody .pagination a').forEach(link => {
                        link.addEventListener('click', function(e) {
                            e.preventDefault();
                            fetchPage(this.href);
                        });
                    });
                })
                .catch(err => {
                    console.error(err);
                    if (spinner) spinner.style.display = 'none';
                });
        }

        function fetchPage(url) {
            if (spinner) spinner.style.display = 'block';
            fetch(url)
                .then(response => response.text())
                .then(html => {
                    tableBody.innerHTML = html;
                    if (spinner) spinner.style.display = 'none';

                    // Ambil query string dari URL
                    const params = new URL(url).searchParams;
                    searchInput.value = params.get('q') || '';
                    filterStatus.value = params.get('status') || '';

                    // Bind pagination baru
                    document.querySelectorAll('#artikelTableBody .pagination a').forEach(link => {
                        link.addEventListener('click', function(e) {
                            e.preventDefault();
                            fetchPage(this.href);
                        });
                    });
                });
        }

        // Event input search dengan delay
        searchInput.addEventListener('keyup', function() {
            clearTimeout(timeout);
            timeout = setTimeout(fetchData, 300);
        });

        // Event select change
        filterStatus.addEventListener('change', fetchData);

        // Bind pagination awal
        document.querySelectorAll('#artikelTableBody .pagination a').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                fetchPage(this.href);
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.btnDelete');
        const deleteForm = document.getElementById('deleteForm');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const slug = this.getAttribute('data-slug');
                deleteForm.action = `/dashboard/tabel-artikel/${slug}`; // route destroy
            });
        });
    });
</script>

<script>
    const initArtikelEditor = () => {
        if (!window.tinymce) return;
        if (tinymce.get('editor-create')) return;

        tinymce.init({
            selector: '#editor-create',
            height: 300,
            menubar: false,
            plugins: 'lists link image table code',
            toolbar: `
            undo redo |
            bold italic underline |
            alignleft aligncenter alignright |
            bullist numlist |
            link table |
            code
        `,
            branding: false,
            setup: editor => {
                editor.on('change', () => editor.save());
            }
        });
    };

    const destroyArtikelEditor = () => {
        if (window.tinymce && tinymce.get('editor-create')) {
            tinymce.remove('#editor-create');
        }
    };

    const modalArtikel = document.getElementById('buatArtikel');
    modalArtikel.addEventListener('shown.bs.modal', initArtikelEditor);
    modalArtikel.addEventListener('hidden.bs.modal', destroyArtikelEditor);
</script>

<script>
    $(document).ready(function() {

        // ======= TinyMCE =======
        const initTinyMCE = (editorId) => {
            if (!window.tinymce) return;
            if (tinymce.get(editorId)) return;

            tinymce.init({
                selector: `#${editorId}`,
                height: 300,
                menubar: false,
                plugins: 'lists link table code image',
                toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright | bullist numlist | link table | code',
                branding: false,
                setup: editor => {
                    editor.on('change', () => editor.save());
                }
            });
        };

        const destroyTinyMCE = (editorId) => {
            if (window.tinymce && tinymce.get(editorId)) {
                tinymce.remove(`#${editorId}`);
            }
        };

        // ======= Dropify =======
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

        const resetDropify = (selector, defaultFile = '') => {
            let drEvent = $(selector).data('dropify');
            if (drEvent) {
                drEvent.resetPreview();
                drEvent.clearElement();
                drEvent.settings.defaultFile = defaultFile;
                drEvent.init();
            }
        };

        // ======= Tombol Edit Artikel =======
        $('.btn-edit-artikel').on('click', function() {
            let artikel = $(this).data('artikel');

            // Set form action
            $('#formEditArtikel').attr('action', '/dashboard/artikel/' + artikel.id);

            // Fill input
            $('#edit_artikel_id').val(artikel.id);
            $('#edit_judul').val(artikel.judul);
            $('#edit_deskripsi').val(artikel.deskripsi);
            $('#edit_kategori').val(artikel.kategori);

            // Set gambar lama
            let defaultFile = artikel.gambar ? "{{ url('/') }}/" + artikel.gambar : '';
            let dropifyInput = $('#edit_gambar');
            // Hancurkan Dropify lama jika ada
            let dr = dropifyInput.data('dropify');
            if (dr) dr.destroy();
            dropifyInput.attr('data-default-file', defaultFile);
            dropifyInput.dropify();

            // Tampilkan modal
            $('#modalEditArtikel').modal('show');
        });

        // ======= Reset saat modal ditutup =======
        $('#modalEditArtikel').on('hidden.bs.modal', function() {
            destroyTinyMCE('edit_deskripsi');
            resetDropify('#edit_gambar', '');
            $('#formEditArtikel')[0].reset();
        });

    });
</script>

@endpush