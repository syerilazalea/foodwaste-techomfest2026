@extends('auth.layouts.app')

@section('content')

<div class="container-fluid p-0 h-100 position-relative">
    <div class="row g-0 h-100">

        <!-- Hero Section (Desktop Only >=992px) -->
        <div class="d-none d-lg-flex col-lg min-h-100">
            <!-- [UBAH] d-none d-lg-flex supaya hero hilang di mobile -->
            <div class="min-h-100 d-flex align-items-center justify-content-center px-5">
                <div class="w-100 w-lg-75 w-xxl-50 text-white">
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
        <div class="col-12 col-lg-auto h-100 justify-content-center align-items-center pb-2 px-4 pt-0 p-lg-0 d-flex">
            <!-- [UBAH] Center card di mobile dengan padding -->
            <div
                class="sw-lg-70 bg-foreground justify-content-center align-items-center d-flex shadow-deep py-5 h-min-100 h-lg-100"
                style="max-width:480px; width:100%; padding:2rem; border-radius:12px;">

                <!-- [UBAH] max-width & padding agar proporsional di mobile -->
                <div class="w-100">
                    <form id="FormRegister" class="tooltip-end-bottom" method="POST" action="{{ route('auth.register.store') }}" novalidate>
                        @csrf
                        <!-- Role Selection -->
                        <div class>
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

                        <button type="submit" class="btn btn-lg btn-primary w-100 mb-3">Daftar Sekarang</button>

                        <!-- Login Link -->
                        <div class="text-center mt-4">
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
</div>
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
                return;
            }

            let encoded = encodeURIComponent(address);

            mapPreview.src =
                "https://www.google.com/maps?q=" + encoded + "&output=embed";
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Elements
        const radios = document.querySelectorAll('input[name="role"]');
        const userRoleInput = document.getElementById('userRole');
        const aktivisFields = document.getElementById('aktivisFields');
        const userFields = document.getElementById('userFields');
        const roleError = document.getElementById('roleError');
        const registerForm = document.getElementById('FormRegister');
        const googleSignInBtn = document.getElementById('googleSignIn');

        // ============================
        // ROLE SELECTION
        // ============================
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

        // ============================
        // FORM SUBMIT VALIDATION + SWEETALERT
        // ============================
        registerForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // ROLE validation
            if (!userRoleInput.value) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian!',
                    text: 'Silakan pilih peran (Kontributor atau Aktivis).'
                });
                return;
            }

            // INPUT VALIDATION
            let name = registerForm.querySelector("input[name='name']").value.trim();
            let email = registerForm.querySelector("input[name='email']").value.trim();
            let phone = registerForm.querySelector("input[name='phone']").value.trim();
            let password = registerForm.querySelector("input[name='password']").value.trim();
            let confirmPassword = registerForm.querySelector("input[name='password_confirmation']").value.trim();

            if (name === "" || email === "" || phone === "" || password === "" || confirmPassword === "") {
                Swal.fire({
                    icon: 'warning',
                    title: 'Input Tidak Lengkap!',
                    text: 'Harap isi semua kolom wajib sebelum melanjutkan.'
                });
                return;
            }

            // Password not match
            if (password !== confirmPassword) {
                Swal.fire({
                    icon: 'error',
                    title: 'Password Tidak Sama!',
                    text: 'Pastikan password dan konfirmasi password sesuai.'
                });
                return;
            }

            // Terms & Conditions
            const termsCheck = document.getElementById('registerCheck');
            if (!termsCheck.checked) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Syarat dan Ketentuan!',
                    text: 'Anda harus menyetujui syarat dan ketentuan untuk melanjutkan.'
                });
                return;
            }

            // If all good → Show Loading
            Swal.fire({
                title: 'Memproses...',
                text: 'Mohon tunggu sebentar.',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Submit after loading
            registerForm.submit();
        });

        // ============================
        // GOOGLE SIGN IN VALIDATION
        // ============================
        if (googleSignInBtn) {
            googleSignInBtn.addEventListener('click', function() {
                if (!userRoleInput.value) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian!',
                        text: 'Silakan pilih peran sebelum mendaftar dengan Google.'
                    });
                    return;
                }
                initGoogleSignIn();
            });
        }

        function initGoogleSignIn() {
            const role = userRoleInput.value;
            const roleName = role === 'aktivis' ? 'Aktivis Lingkungan' : 'Kontributor';

            Swal.fire({
                icon: 'info',
                title: 'Menghubungkan...',
                text: `Mengarahkan ke Google Sign In untuk mendaftar sebagai ${roleName}.`,
                timer: 2000,
                showConfirmButton: false
            });
        }

    });
</script>
<!-- Page Specific Scripts End -->

@endpush