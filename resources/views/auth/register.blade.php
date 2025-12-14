@extends('auth.layouts.app')

@push('styles')

<style>
/* Desktop tetap seperti sekarang */
@media (min-width: 992px) {
    .login-card {
        min-height: 100vh;
    }
}

/* Mobile */
@media (max-width: 991.98px) {
    .col-12.col-lg-auto {
        display: block !important;        /* hilangkan flex vertical center */
        padding: 2rem 1rem;
        height: auto !important;
    }

    .login-card {
        width: 50%;
        max-height: 90vh;                  /* maksimal 90% tinggi layar */
        margin: 3px auto !important;
        padding: 1.5rem;
        background-color: #fff;
        border-radius: 1rem !important;
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
        overflow-y: auto;                  /* scrollable */
        display: block;
    }

    .login-card-inner {
        width: 100%;
        background-color: transparent;
        border-radius: inherit;
    }

       #mapPreview {
        display: none !important;
    }
    }
</style>

@endpush

@section('content')

<div class="container-fluid p-0 h-100 position-relative">
    <div class="row g-0 h-100">
        <!-- Desktop Left Content -->
        <div class="offset-0 col-12 d-none d-lg-flex offset-md-1 col-lg h-lg-100">
            <div class="min-h-100 d-flex align-items-center">
                <div class="w-100 w-lg-75 w-xxl-50">
                    <div class="mb-5">
                        <h1 class="display-3 text-white">Econect</h1>
                        <h1 class="display-6 text-white">Reduce Food Waste Together</h1>
                    </div>
                    <p class="h6 text-white lh-1-6 mb-5">
                        Bersama, kita membangun ekosistem yang lebih berkelanjutan.
                        Melalui layanan ini, Anda dapat menyalurkan makanan berlebih kepada sesama,
                        menerima makanan dari komunitas, serta membagikan limbah makanan atau bahan
                        pangan yang sudah tidak layak konsumsi untuk diolah menjadi kompos.
                    </p>
                    <div class="mb-5">
                        <a class="btn btn-lg btn-outline-white" href="home.html">Pelajari Lebih Lanjut</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Left Side End -->

        <!-- Right Side Start -->
        <div class="col-12 col-lg-auto h-100 pb-2 px-4 pt-0 p-lg-0">
            <div class="sw-lg-70 min-h-100 bg-foreground d-flex justify-content-center align-items-center shadow-deep py-5 full-page-content-right-border login-card">
                <div class="sw-lg-50 w-100 login-card-inner">
                    <form id="FormRegister" class="tooltip-end-bottom" method="POST" action="{{ route('auth.register.store') }}" novalidate>
                        @csrf
                        <!-- Role Selection -->
                        <div>
                            <label class="form-label fw-bold justify-center">Daftar Sebagai</label>
                            <!-- User -->
                            <div class="mb-3 filled custom-control-container">
                                <i data-acorn-icon="user" class="text-primary"></i>
                                <div class="form-check">
                                    <input type="radio" id="roleUser" name="role" value="user" class="form-check-input" />
                                    <label class="form-check-label" for="roleUser">Kontributor</label>
                                </div>
                            </div>

                            <!-- Aktivis -->
                            <div class="mb-3 filled custom-control-container">
                                <i data-acorn-icon="leaf" class="text-success"></i>
                                <div class="form-check">
                                    <input type="radio" id="roleAktivis" name="role" value="aktivis" class="form-check-input" />
                                    <label class="form-check-label" for="roleAktivis">Aktivis</label>
                                </div>
                            </div>

                            <input type="hidden" name="userRole" id="userRole" required>
                            <div class="text-danger small mt-1" id="roleError"></div>
                        </div>

                        <div class="mb-3 filled form-group tooltip-end-top">
                            <i data-acorn-icon="user"></i>
                            <input class="form-control" placeholder="Nama Lengkap" name="name" required />
                        </div>
                        <div class="mb-3 filled form-group tooltip-end-top">
                            <i data-acorn-icon="email"></i>
                            <input class="form-control" placeholder="Masukkan Email" name="email" type="email" required />
                        </div>
                        <div class="mb-3 filled form-group tooltip-end-top">
                            <i data-acorn-icon="phone"></i>
                            <input class="form-control" placeholder="Masukkan Nomor Telepon" name="phone" required />
                        </div>
                        <div class="mb-3 filled form-group tooltip-end-top">
                            <i data-acorn-icon="lock-off"></i>
                            <input class="form-control" name="password" type="password" placeholder="Masukkan Password" required minlength="6" />
                        </div>
                        <div class="mb-3 filled form-group tooltip-end-top">
                            <i data-acorn-icon="lock-on"></i>
                            <input class="form-control" name="password_confirmation" type="password" placeholder="Konfirmasi Password" required />
                        </div>

                        <!-- Additional Fields for Environmental Activist -->
                        <div id="aktivisFields" class="d-none">
                            <div class="mb-3 filled form-group tooltip-end-top">
                                <i data-acorn-icon="building-large"></i>
                                <input class="form-control" placeholder="Masukkan Nama Organisasi/Komunitas" name="organisasi" />
                            </div>
                        </div>
                        <!-- Additional Fields for Regular User -->
                        <div id="userFields" class="d-none">
                            <!-- Input Alamat -->
                            <div class="mb-3 filled form-group tooltip-end-top">
                                <i data-acorn-icon="pin"></i>
                                <input class="form-control" placeholder="Masukkan Alamat"
                                    name="alamat" id="alamatInput" />
                            </div>

                            <!-- Preview Lokasi Otomatis -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Preview Lokasi</label>
                                <iframe id="mapPreview" width="100%" height="250" style="border:0; border-radius: 10px;"></iframe>
                            </div>
                        </div>

                        <div class="mb-3 position-relative form-group">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="registerCheck" name="terms" required />
                                <label class="form-check-label" for="registerCheck">
                                    Saya menyetujui
                                    <a href="#" target="_blank">syarat dan ketentuan</a>
                                    yang berlaku.
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-lg btn-primary w-100">Daftar Sekarang</button>

                        <!-- Login Link -->
                        <div class="text-center mt-3">
                            <p class="text-muted mb-0">
                                Sudah punya akun?
                                <a href="{{ route('auth.login') }}" class="text-primary text-decoration-none">Masuk di sini</a>
                            </p>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- Right Side End -->
</div>

@endsection

@push('scripts')

<script>
    // === AUTO PREVIEW GOOGLE MAPS ===
    document.addEventListener("DOMContentLoaded", function() {
        const alamatInput = document.getElementById('alamatInput');
        const mapPreview = document.getElementById('mapPreview');

        alamatInput.addEventListener('input', function() {
            let address = alamatInput.value.trim();

            if (address.length < 3) {
                mapPreview.src = "";
                mapPreview.style.display = "none";
                return;
            }

            mapPreview.src = "https://www.google.com/maps?q=" + encodeURIComponent(address) + "&output=embed";
            mapPreview.style.display = "block";

            // Jangan scroll otomatis → biarkan user scroll sendiri
        });

    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const alamatInput = document.getElementById('alamatInput');
        const mapPreview = document.getElementById('mapPreview');
        const radios = document.querySelectorAll('input[name="role"]');
        const userRoleInput = document.getElementById('userRole');
        const aktivisFields = document.getElementById('aktivisFields');
        const userFields = document.getElementById('userFields');
        const roleError = document.getElementById('roleError');
        const registerForm = document.getElementById('FormRegister');

        // Hide iframe awal
        if (mapPreview) mapPreview.style.display = "none";

        // Role Selection
        radios.forEach(radio => {
            radio.addEventListener('change', function() {
                roleError.textContent = "";
                userRoleInput.value = this.value;

                if (this.value === "user") {
                    userFields.classList.remove("d-none");
                    aktivisFields.classList.add("d-none");
                } else {
                    aktivisFields.classList.remove("d-none");
                    userFields.classList.add("d-none");
                }
            });
        });

        // Alamat input -> map
        if (alamatInput) {
            alamatInput.addEventListener('input', function() {
                let address = alamatInput.value.trim();

                if (address.length < 3) {
                    mapPreview.src = "";
                    mapPreview.style.display = "none";
                    return;
                }

                mapPreview.src = "https://www.google.com/maps?q=" + encodeURIComponent(address) + "&output=embed";
                mapPreview.style.display = "block";

                // Jangan scroll otomatis → biarkan user scroll sendiri
            });

        }

        // Form submit validation
        registerForm.addEventListener('submit', function(e) {
            e.preventDefault();

            if (!userRoleInput.value) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian!',
                    text: 'Silakan pilih peran (Kontributor atau Aktivis).'
                });
                return;
            }

            const name = registerForm.querySelector("input[name='name']").value.trim();
            const email = registerForm.querySelector("input[name='email']").value.trim();
            const phone = registerForm.querySelector("input[name='phone']").value.trim();
            const password = registerForm.querySelector("input[name='password']").value.trim();
            const confirmPassword = registerForm.querySelector("input[name='password_confirmation']").value.trim();

            if (name === "" || email === "" || phone === "" || password === "" || confirmPassword === "") {
                Swal.fire({
                    icon: 'warning',
                    title: 'Input Tidak Lengkap!',
                    text: 'Harap isi semua kolom wajib sebelum melanjutkan.'
                });
                return;
            }

            if (password !== confirmPassword) {
                Swal.fire({
                    icon: 'error',
                    title: 'Password Tidak Sama!',
                    text: 'Pastikan password dan konfirmasi password sesuai.'
                });
                return;
            }

            if (!document.getElementById('registerCheck').checked) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Syarat dan Ketentuan!',
                    text: 'Anda harus menyetujui syarat dan ketentuan untuk melanjutkan.'
                });
                return;
            }

            Swal.fire({
                title: 'Memproses...',
                text: 'Mohon tunggu sebentar.',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => Swal.showLoading()
            });

            registerForm.submit();
        });
    });
</script>
<!-- Page Specific Scripts End -->

@endpush