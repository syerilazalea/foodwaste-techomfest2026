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
                                            <button class="btn btn-sm btn-icon btn-icon-only btn-outline-secondary me-1"
                                                data-bs-toggle="modal" data-bs-target="#modalEditArtikel{{ $artikel->id }}">
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
                                    <!-- Modal Edit Artikel -->
                                    <div class="modal fade" id="modalEditArtikel{{ $artikel->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <form action="{{ route('dashboard.artikel.update', $artikel->slug) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Artikel</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label class="form-label">Judul Artikel</label>
                                                            <input type="text" class="form-control" name="judul" value="{{ $artikel->judul }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Konten Artikel</label>
                                                            <textarea class="form-control" name="deskripsi" id="editor-edit" rows="6">{!! $artikel->deskripsi !!}</textarea>
                                                        </div>
                                                        <div class="mb-3 row align-items-center">
                                                            <div class="col-md-6">
                                                                <label class="form-label">Gambar Utama</label>
                                                                <input type="file" name="gambar" id="dropifyInput" class="form-control"
                                                                    data-default-file="{{ $artikel->gambar ? asset($artikel->gambar) : '' }}"
                                                                    accept="image/*">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label d-block">&nbsp;</label>
                                                                <img src="{{ asset($artikel->gambar) }}" class="rounded img-thumbnail"
                                                                    style="width: 200px; height: 200px; object-fit: cover;">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Kategori</label>
                                                            <select class="form-select" name="kategori">
                                                                <option value="edukasi" {{ $artikel->kategori == 'edukasi' ? 'selected' : '' }}>Edukasi</option>
                                                                <option value="tips & trik" {{ $artikel->kategori == 'tips & trik' ? 'selected' : '' }}>Tips & Trik</option>
                                                                <option value="berita" {{ $artikel->kategori == 'berita' ? 'selected' : '' }}>Berita</option>
                                                                <option value="tutorial" {{ $artikel->kategori == 'tutorial' ? 'selected' : '' }}>Tutorial</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Update Artikel</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>
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
                        <textarea name="deskripsi" id="editor-create" class="form-control" rows="6" placeholder="Tulis konten artikel di sini..."></textarea>
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

<script type="text/javascript">
    tinymce.init({
        selector: '#editor-create',
        plugins: [
            'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'pagebreak',
            'searchreplace', 'wordcount', 'visualblocks', 'visualchars', 'code', 'fullscreen', 'insertdatetime',
            'media', 'table', 'emoticons', 'help'
        ],
        toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
            'forecolor backcolor emoticons | help',
        menu: {
            favs: {
                title: 'My Favorites',
                items: 'code visualaid | searchreplace | emoticons'
            }
        },
        menubar: 'favs file edit view insert format tools table help',
    });
</script>

<script type="text/javascript">
    tinymce.init({
        selector: '#editor-edit',
        plugins: [
            'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'pagebreak',
            'searchreplace', 'wordcount', 'visualblocks', 'visualchars', 'code', 'fullscreen', 'insertdatetime',
            'media', 'table', 'emoticons', 'help'
        ],
        toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
            'forecolor backcolor emoticons | help',
        menu: {
            favs: {
                title: 'My Favorites',
                items: 'code visualaid | searchreplace | emoticons'
            }
        },
        menubar: 'favs file edit view insert format tools table help',
    });
</script>

@endpush