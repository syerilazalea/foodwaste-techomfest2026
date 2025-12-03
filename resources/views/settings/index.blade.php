@extends('dashboard.layouts.app')

@section('content')
<main>
    <div class="container">
        <div class="page-title-container">
            <div class="row">
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-xl-4 col-xxl-3">
                <h2 class="small-title">Informasi Umum</h2>
                <div class="card mb-5">
                    <div class="card-body">
                        <div class="d-flex align-items-center flex-column mb-4">
                            <div class="d-flex align-items-center flex-column">
                                <!-- Preview gambar -->
                                <div class="sw-13 position-relative mb-3">
                                    <img src="{{ asset($user->gambar) }}"
                                        class="img-fluid rounded-xl"
                                        alt="{{ $user->name }}"
                                        id="previewImage">
                                </div>
                                <div class="h5 mb-0">{{ $user->name }}</div>
                                <div class="text-muted">{{ $user->role }}</div>
                                <div class="text-muted">
                                    <i data-acorn-icon="pin" class="me-1"></i>
                                    <span class="align-middle">{{ $user->alamat }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="nav flex-column" role="tablist">
                            <a class="nav-link active px-0 border-bottom border-separator-light" data-bs-toggle="tab" href="#overviewTab" role="tab">
                                <i data-acorn-icon="activity" class="me-2" data-acorn-size="17"></i>
                                <span class="align-middle">Profil</span>
                            </a>
                            <a class="nav-link px-0 border-bottom border-separator-light" data-bs-toggle="tab" href="#projectsTab" role="tab">
                                <i data-acorn-icon="office" class="me-2" data-acorn-size="17"></i>
                                <span class="align-middle">Kontak</span>
                            </a>
                            <a class="nav-link px-0 border-bottom border-separator-light" data-bs-toggle="tab" href="#permissionsTab" role="tab">
                                <i data-acorn-icon="lock-off" class="me-2" data-acorn-size="17"></i>
                                <span class="align-middle">Kata Sandi</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-12 col-xl-8 col-xxl-9 mb-5 tab-content">
                <div class="tab-pane fade show active" id="overviewTab" role="tabpanel">
                    <h2 class="small-title">Profil</h2>
                    <div class="card mb-5">
                        <div class="card-body">
                            <form action="{{ route('settings.updateProfile') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3 row">
                                    <label class="col-lg-2 col-md-3 col-sm-4 col-form-label">Gambar Profile</label>
                                    <div class="col-sm-8 col-md-9 col-lg-10">
                                        <input type="file" class="form-control dropify" name="gambar" id="dropifyInput" accept="image/*">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-lg-2 col-md-3 col-sm-4 col-form-label">Nama</label>
                                    <div class="col-sm-8 col-md-9 col-lg-10">
                                        <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" placeholder="Tulis Nama" />
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-2 col-md-3 col-sm-4 col-form-label">Alamat</label>
                                    <div class="col-sm-8 col-md-9 col-lg-10">
                                        <input type="text" class="form-control"
                                            name="alamat"
                                            id="alamatInput"
                                            value="{{ old('alamat', $user->alamat) }}"
                                            placeholder="Masukkan Alamat" />
                                    </div>
                                </div>
                                @if($user->iframe_maps)
                                <div class="mb-3 row">
                                    <label class="col-lg-2 col-md-3 col-sm-4 col-form-label">Preview Lokasi</label>
                                    <div class="col-sm-8 col-md-9 col-lg-10">
                                        <iframe id="mapPreview"
                                            src="{{ $user->iframe_maps }}"
                                            width="100%" height="270"
                                            style="border:0; border-radius: 10px;"></iframe>
                                    </div>
                                </div>
                                @endif
                                <div class="mb-3 row mt-5">
                                    <div class="col-sm-8 col-md-9 col-lg-10 ms-auto">
                                        <button type="submit" class="btn btn-outline-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="projectsTab" role="tabpanel">
                    <h2 class="small-title">Contact</h2>
                    <div class="card mb-5">
                        <div class="card-body">
                            <form action="{{route ('settings.updateKontak')}}" method="POST">
                                @csrf
                                <div class="mb-3 row">
                                    <label class="col-lg-2 col-md-3 col-sm-4 col-form-label">Email</label>
                                    <div class="col-sm-8 col-md-9 col-lg-10">
                                        <input type="email" class="form-control" name="email" value="{{ $user->email }}" disabled />
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-2 col-md-3 col-sm-4 col-form-label">No Telpon</label>
                                    <div class="col-sm-8 col-md-9 col-lg-10">
                                        <input type="text" class="form-control" name="phone" value="{{ old('phone', $user->phone) }}" />
                                    </div>
                                </div>
                                <div class="mb-3 row mt-5">
                                    <div class="col-sm-8 col-md-9 col-lg-10 ms-auto">
                                        <button type="submit" class="btn btn-outline-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="permissionsTab" role="tabpanel">
                    <h2 class="small-title">Ubah Kata Sandi</h2>
                    <div class="card mb-5">
                        <div class="card-body">
                            <form action="{{route ('settings.updatePassword')}}" method="POST">
                                @csrf
                                <div class="mb-3 row">
                                    <label class="col-lg-2 col-md-3 col-sm-4 col-form-label">Kata
                                        Sandi</label>
                                    <div class="col-sm-8 col-md-9 col-lg-10">
                                        <input class="form-control" type="password" name="password" placeholder="Masukkan Kata Sandi" name="passwordFilled" required />
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-2 col-md-3 col-sm-4 col-form-label">Ulangi Kata
                                        Sandi</label>
                                    <div class="col-sm-8 col-md-9 col-lg-10">
                                        <input class="form-control" type="password" name="password_confirmation" placeholder="Masukkan Kata Sandi" name="passwordFilled" required />

                                    </div>
                                </div>
                                <div class="mb-3 row mt-5">
                                    <div class="col-sm-8 col-md-9 col-lg-10 ms-auto">
                                        <button type="submit" class="btn btn-outline-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
</main>
@endsection

@push('scripts')

<!-- Preview Maps -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const alamatInput = document.getElementById('alamatInput');
        const mapPreview = document.getElementById('mapPreview');

        alamatInput.addEventListener('input', function() {
            const alamat = alamatInput.value.trim();

            if (alamat.length < 3) {
                mapPreview.src = "";
                return;
            }

            const encoded = encodeURIComponent(alamat);
            mapPreview.src = `https://www.google.com/maps?q=${encoded}&output=embed`;
        });
    });
</script>

@endpush