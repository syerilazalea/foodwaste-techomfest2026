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
        <div class="row">
            <div class="col-12">
                <div class="page-title-container">
                    @include('dashboard.components.breadcrumbs')
                    <p class="mb-0 text-muted">Kelola semua agenda kegiatan lingkungan</p>
                </div>
            </div>
        </div>

        <!-- Tabel Agenda -->
        <div class="row">
            <section class="scroll-section" id="alwaysResponsive">
                <div class="card mb-5">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0 fw-bold">Daftar Agenda</h5>
                            <div class="d-flex gap-2 mb-3">
                                <!-- Input Text Search -->
                                <div class="input-group" style="width: 250px;">
                                    <input type="text" id="searchInput" class="form-control" placeholder="Cari agenda...">
                                    <button class="btn btn-outline-secondary" type="button">
                                        <i data-acorn-icon="search"></i>
                                    </button>
                                </div>
                                <!-- Select Status Filter -->
                                <select id="filterStatus" class="form-select" style="width: 150px;">
                                    <option value="">Semua Status</option>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Nonaktif">Nonaktif</option>
                                </select>
                                <button class="btn btn-primary d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#buatAgenda">
                                    <i data-acorn-icon="plus"></i>
                                    <span>Buat Agenda</span>
                                </button>
                            </div>
                        </div>

                        <div class="table-responsive table-scroll">
                            @php
                            $userAgendas = $agendas->where('user_id', auth()->id());
                            @endphp

                            @if($userAgendas->isEmpty())
                            <div class="d-flex flex-column justify-content-center align-items-center" style="min-height: 250px;">
                                <img src="{{ asset('img/page/no-data.svg') }}" alt="Tidak ada agenda" class="img-fluid mb-3" style="max-height: 150px;">
                                <p class="text-center text-muted mb-0">Belum ada data agenda.</p>
                            </div>
                            @else
                            <table class="table align-middle" id="dataTableAgenda">
                                <thead>
                                    <tr>
                                        <th>Gambar</th>
                                        <th>Nama Kegiatan</th>
                                        <th>Tanggal & Waktu</th>
                                        <th>Lokasi</th>
                                        <th>Kuota</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <div id="loadingSpinner" class="text-center my-3" style="display: none;">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                                <tbody id="agendaTableBody">
                                    @foreach($agendas as $agenda)
                                    <tr>
                                        <td>
                                            @if($agenda->gambar)
                                            <img src="{{ asset($agenda->gambar) }}" class="rounded sw-8 sh-8">
                                            @else
                                            <span class="text-muted">Tidak ada gambar</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="fw-bold">{{ $agenda->nama_kegiatan }}</div>
                                            <div class="text-muted small">{{ Str::limit(strip_tags($agenda->deskripsi), 80) }}</div>
                                        </td>
                                        <td>
                                            <div>{{ \Carbon\Carbon::parse($agenda->tanggal)->format('d M Y') }}</div>
                                            <div class="text-muted small">{{ $agenda->waktu_mulai }} - {{ $agenda->waktu_selesai }} WIB</div>
                                        </td>
                                        <td>{{ $agenda->lokasi }}</td>
                                        <td>{{ $agenda->kuota }}/{{ $agenda->kuota }}</td> <!-- bisa disesuaikan jika ada peserta -->
                                        <td>
                                            <span class="badge {{ $agenda->status == 'Aktif' ? 'bg-info' : 'bg-secondary' }}">{{ $agenda->status }}</span>
                                        </td>
                                        <td class="text-nowrap">
                                            <!-- Tombol Edit -->
                                            <button class="btn btn-sm btn-icon btn-icon-only btn-outline-secondary me-1 btn-edit-agenda"
                                                data-agenda='@json($agenda)'>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                    <path d="M12.854.146a.5.5 0 0 1 .646.058l2.292 2.292a.5.5 0 0 1-.058.646L4.207 14.793 1 15l.207-3.207L12.854.146z" />
                                                </svg>
                                            </button>

                                            <!-- Tombol Delete -->
                                            <button class="btn btn-sm btn-icon btn-icon-only btn-outline-danger btnDelete"
                                                data-slug="{{ $agenda->id }}"
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

                        <nav class="mt-3">
                            <div class="d-flex justify-content-end mt-3">
                                <div class="d-flex justify-content-end mt-3">
                                    {{ $agendas->links('vendor.pagination.bootstrap-5') }}
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>

<!-- Modal Edit Agenda -->
<div class="modal fade" id="modalEditAgenda" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="formEditAgenda" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Agenda</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- Hidden ID -->
                    <input type="hidden" id="edit_agenda_id" name="agenda_id">

                    <div class="mb-3">
                        <label class="form-label">Judul Agenda</label>
                        <input type="text" id="edit_nama_kegiatan" name="nama_kegiatan" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Konten Agenda</label>
                        <textarea id="edit_deskripsi" name="deskripsi" class="form-control" rows="6" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gambar Agenda</label>
                        <input type="file" id="edit_gambar" name="gambar" class="form-control dropify-edit" data-default-file="" accept="image/*">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal</label>
                        <input type="date" id="edit_tanggal" name="tanggal" class="form-control" required>
                        <small class="text-danger d-none" id="timeError"></small>
                    </div>

                    <div class="mb-3 d-flex gap-2">
                        <div>
                            <label class="form-label">Waktu Mulai</label>
                            <input type="time" id="edit_waktu_mulai" name="waktu_mulai" class="form-control" required>
                        </div>
                        <div>
                            <label class="form-label">Waktu Selesai</label>
                            <input type="time" id="edit_waktu_selesai" name="waktu_selesai" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Lokasi</label>
                        <input type="text" id="edit_lokasi" name="lokasi" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kuota</label>
                        <input type="number" id="edit_kuota" name="kuota" class="form-control" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update Agenda</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal Buat Artikel -->
<div class="modal fade" id="buatAgenda" tabindex="-1" aria-labelledby="buatAgendaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('dashboard.agenda.store') }}" method="POST" enctype="multipart/form-data" required>
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="buatAgendaLabel">Buat Agenda Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Judul Agenda</label>
                        <input type="text" name="nama_kegiatan" class="form-control" placeholder="Masukkan judul agenda" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Konten Agenda</label>
                        <textarea name="deskripsi" id="editor-create" class="form-control" rows="6" placeholder="Tulis konten agenda di sini..." required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gambar</label>
                        <input type="file" class="form-control dropify" name="gambar" id="gambar" accept="image/*" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" required>
                        <small class="text-danger d-none" id="timeError"></small>
                    </div>

                    <div class="mb-3 d-flex gap-2">
                        <div>
                            <label class="form-label">Waktu Mulai</label>
                            <input type="time" name="waktu_mulai" class="form-control" required>
                            <small class="text-danger d-none" id="timeError"></small>
                        </div>
                        <div>
                            <label class="form-label">Waktu Selesai</label>
                            <input type="time" name="waktu_selesai" class="form-control" required>
                            <small class="text-danger d-none" id="timeError"></small>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Lokasi</label>
                        <input type="text" name="lokasi" class="form-control" placeholder="Masukkan lokasi" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kuota</label>
                        <input type="number" name="kuota" class="form-control" placeholder="Masukkan kuota" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="Aktif" selected>Aktif</option>
                            <option value="Nonaktif">Nonaktif</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Agenda</button>
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
        const tableBody = document.getElementById('agendaTableBody');
        const spinner = document.getElementById('loadingSpinner');
        let timeout = null;

        function fetchData() {
            const status = filterStatus.value;
            const keyword = searchInput.value;
            const url = `{{ route('dashboard.agenda.search') }}?status=${encodeURIComponent(status)}&q=${encodeURIComponent(keyword)}`;

            if (spinner) spinner.style.display = 'block';

            fetch(url)
                .then(response => response.text())
                .then(html => {
                    tableBody.innerHTML = html;
                    if (spinner) spinner.style.display = 'none';

                    // Bind pagination
                    document.querySelectorAll('#agendaTableBody .pagination a').forEach(link => {
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
                    document.querySelectorAll('#agendaTableBody .pagination a').forEach(link => {
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
        document.querySelectorAll('#agendaTableBody .pagination a').forEach(link => {
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
                deleteForm.action = `/dashboard/tabel-agenda/${slug}`; // route destroy
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tanggalInput = document.querySelector('input[name="tanggal"]');
        const waktuMulai = document.querySelector('input[name="waktu_mulai"]');
        const waktuSelesai = document.querySelector('input[name="waktu_selesai"]');
        const errorEl = document.getElementById('timeError');

        function validateTime() {
            errorEl.classList.add('d-none');
            waktuMulai.classList.remove('is-invalid');

            if (!tanggalInput.value || !waktuMulai.value) return;

            const today = new Date();
            const selectedDate = new Date(tanggalInput.value);

            // Jika tanggal hari ini
            if (selectedDate.toDateString() === today.toDateString()) {
                const nowTime = today.toTimeString().slice(0, 5);

                if (waktuMulai.value < nowTime) {
                    errorEl.textContent = 'Waktu mulai tidak boleh kurang dari waktu sekarang';
                    errorEl.classList.remove('d-none');
                    waktuMulai.classList.add('is-invalid');
                }
            }
        }

        tanggalInput.addEventListener('change', validateTime);
        waktuMulai.addEventListener('input', validateTime);
    });
</script>

<script>
    const initAgendaEditor = () => {
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

    const destroyAgendaEditor = () => {
        if (window.tinymce && tinymce.get('editor-create')) {
            tinymce.remove('#editor-create');
        }
    };

    const modal = document.getElementById('buatAgenda');
    modal.addEventListener('shown.bs.modal', initAgendaEditor);
    modal.addEventListener('hidden.bs.modal', destroyAgendaEditor);
</script>

<script>
    $(document).ready(function() {

        // ===== TinyMCE =====
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
                setup: editor => editor.on('change', () => editor.save())
            });
        };

        const destroyTinyMCE = (editorId) => {
            if (window.tinymce && tinymce.get(editorId)) tinymce.remove(`#${editorId}`);
        };

        // ===== Dropify =====
        const initDropify = (selector) => {
            let $input = $(selector);
            if (!$input.hasClass('dropify-initialized')) {
                $input.dropify({
                    messages: {
                        default: 'Drag or drop your image',
                        replace: 'Drag or drop to replace',
                        remove: 'Remove image',
                        error: 'Oops, invalid file!'
                    }
                    
                });
                $input.addClass('dropify-initialized');
            }
        };

        const resetDropify = (selector, defaultFile = '') => {
            let $input = $(selector);
            let dr = $input.data('dropify');
            if (dr) {
                dr.destroy();
            }
            $input.attr('data-default-file', defaultFile);
            $input.dropify();
            $input.data('dropify').resetPreview();
        };

        // ===== Tombol Edit =====
        $('.btn-edit-agenda').on('click', function() {
            let agenda = $(this).data('agenda');

            // Set form action
            $('#formEditAgenda').attr('action', '/dashboard/agenda/' + agenda.id);

            // Fill input
            $('#edit_agenda_id').val(agenda.id);
            $('#edit_nama_kegiatan').val(agenda.nama_kegiatan);
            $('#edit_deskripsi').val(agenda.deskripsi);
            $('#edit_tanggal').val(agenda.tanggal);
            $('#edit_waktu_mulai').val(agenda.waktu_mulai);
            $('#edit_waktu_selesai').val(agenda.waktu_selesai);
            $('#edit_lokasi').val(agenda.lokasi);
            $('#edit_kuota').val(agenda.kuota);

            // Destroy Dropify lama
            let dr = $('#edit_gambar').data('dropify');
            if (dr) dr.destroy();

            // Set default file yang absolut & init Dropify
            let defaultFile = agenda.gambar ? "{{ url('/') }}/" + agenda.gambar : '';
            $('#edit_gambar').attr('data-default-file', defaultFile).dropify();

            // TinyMCE
            if (tinymce.get('edit_deskripsi')) tinymce.get('edit_deskripsi').remove();
            tinymce.init({
                selector: '#edit_deskripsi',
                height: 300,
                menubar: false,
                plugins: 'lists link table code image',
                toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright | bullist numlist | link table | code',
                setup: editor => editor.on('change', () => editor.save())
            });

            // Tampilkan modal
            $('#modalEditAgenda').modal('show');
        });

        // ===== Reset saat modal ditutup =====
        $('#modalEditAgenda').on('hidden.bs.modal', function() {
            destroyTinyMCE('edit_deskripsi');
            resetDropify('#edit_gambar', '');
            $('#formEditAgenda')[0].reset();
        });

    });
</script>
@endpush