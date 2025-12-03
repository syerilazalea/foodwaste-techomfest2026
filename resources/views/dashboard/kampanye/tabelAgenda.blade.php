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
                    <h1 class="mb-0 pb-0 display-4" id="title">Kelola Agenda</h1>
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
                            <h5 class="mb-0 fw-bold">Daftar Artikel</h5>
                            <div class="d-flex gap-2">
                                <div class="input-group" style="width: 250px;">
                                    <input type="text" id="searchInput" class="form-control" placeholder="Cari agenda...">
                                    <button class="btn btn-outline-secondary" type="button">
                                        <i data-acorn-icon="search"></i>
                                    </button>
                                </div>
                                <select class="form-select" style="width: 150px;">
                                    <option value="">Semua Status</option>
                                    <option value="published">Published</option>
                                    <option value="draft">Draft</option>
                                </select>
                                <button class="btn btn-primary d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#buatAgenda">
                                    <i data-acorn-icon="plus"></i>
                                    <span>Buat Artikel</span>
                                </button>
                            </div>
                        </div>

                        <div class="table-responsive table-scroll">
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
                                            <button class="btn btn-sm btn-icon btn-icon-only btn-outline-secondary me-1"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalEditAgenda{{ $agenda->id }}">
                                                <i data-acorn-icon="pen"></i>
                                            </button>

                                            <!-- Tombol Delete -->
                                            <button class="btn btn-sm btn-icon btn-icon-only btn-outline-danger btnDelete"
                                                data-slug="{{ $agenda->id }}"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalDelete">
                                                <i data-acorn-icon="bin"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Modal Edit khusus untuk agenda ini -->
                                    <div class="modal fade" id="modalEditAgenda{{ $agenda->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <form action="{{ route('dashboard.agenda.update', $agenda->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Agenda</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label class="form-label">Judul Agenda</label>
                                                            <input type="text" name="nama_kegiatan" class="form-control" value="{{ $agenda->nama_kegiatan }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Konten Agenda</label>
                                                            <textarea name="deskripsi" id="editor-edit" class="form-control" rows="6">{!! $agenda->deskripsi !!}</textarea>
                                                        </div>
                                                        <div class="mb-3 row align-items-center">
                                                            <div class="col-md-6">
                                                                <label class="form-label">Gambar Utama</label>
                                                                <input type="file" name="gambar" id="dropifyInput" class="form-control"
                                                                    data-default-file="{{ $agenda->gambar ? asset($agenda->gambar) : '' }}"
                                                                    accept="image/*">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label d-block">&nbsp;</label>
                                                                <img src="{{ asset($agenda->gambar) }}" class="rounded img-thumbnail"
                                                                    style="width: 200px; height: 200px; object-fit: cover;">
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label">Tanggal</label>
                                                            <input type="date" name="tanggal" class="form-control" value="{{ $agenda->tanggal }}" required>
                                                        </div>
                                                        <div class="mb-3 d-flex gap-2">
                                                            <div>
                                                                <label class="form-label">Waktu Mulai</label>
                                                                <input type="time" name="waktu_mulai" class="form-control" value="{{ $agenda->waktu_mulai }}" required>
                                                            </div>
                                                            <div>
                                                                <label class="form-label">Waktu Selesai</label>
                                                                <input type="time" name="waktu_selesai" class="form-control" value="{{ $agenda->waktu_selesai }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Lokasi</label>
                                                            <input type="text" name="lokasi" class="form-control" value="{{ $agenda->lokasi }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Kuota</label>
                                                            <input type="number" name="kuota" class="form-control" value="{{ $agenda->kuota }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Status</label>
                                                            <select name="status" class="form-select">
                                                                <option value="Aktif" {{ $agenda->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                                                <option value="Nonaktif" {{ $agenda->status == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                                            </select>
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
                                    @endforeach
                                </tbody>
                            </table>
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

<!-- Modal Buat Artikel -->
<div class="modal fade" id="buatAgenda" tabindex="-1" aria-labelledby="buatAgendaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('dashboard.agenda.store') }}" method="POST" enctype="multipart/form-data">
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
                        <textarea name="deskripsi" id="editor-create" class="form-control" rows="6" placeholder="Tulis konten agenda di sini..."></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gambar</label>
                        <input type="file" class="form-control dropify" name="gambar" id="gambar" accept="image/*">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" required>
                    </div>

                    <div class="mb-3 d-flex gap-2">
                        <div>
                            <label class="form-label">Waktu Mulai</label>
                            <input type="time" name="waktu_mulai" class="form-control" required>
                        </div>
                        <div>
                            <label class="form-label">Waktu Selesai</label>
                            <input type="time" name="waktu_selesai" class="form-control" required>
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
                        <select name="status" class="form-select">
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