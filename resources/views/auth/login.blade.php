@extends('auth.layouts.app')

@push('styles')

<style>
    .invalid-feedback {
        display: none;
    }

    .is-invalid~.invalid-feedback {
        display: block;
    }
</style>

@endpush

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

        <!-- Login Card (Always Visible) -->
        <div class="col-12 col-lg-auto h-100 justify-content-center align-items-center pb-2 px-4 pt-0 p-lg-0 d-flex">
            <!-- [UBAH] Center card di mobile dengan padding -->
            <div
                class="sw-lg-70 bg-foreground justify-content-center align-items-center d-flex shadow-deep py-5 h-min-100 h-lg-100"
                style="max-width:480px; width:100%; padding:2rem; border-radius:12px;">

                <!-- [UBAH] max-width & padding agar proporsional di mobile -->
                <div class="w-100">
                    <form id="loginForm" class="tooltip-end-bottom" method="POST" action="{{ route('auth.login.store') }}">
                        @csrf
                        <!-- Title -->
                        <div class="mb-5 text-center">
                            <h2 class="display-5 fw-bold">Masuk ke Econect</h2>
                            <p class="text-muted mt-2">Akses akun Anda untuk melanjutkan</p>
                        </div>

                        <!-- Email -->
                        <div class="mb-3 filled form-group tooltip-end-top">
                            <i data-acorn-icon="email"></i>
                            <input class="form-control" placeholder="Email" name="email" type="email" id="emailInput" />
                            <div class="invalid-feedback">Email wajib diisi.</div>
                        </div>

                        <!-- Password -->
                        <div class="mb-3 filled form-group tooltip-end-top">
                            <i data-acorn-icon="lock-on"></i>
                            <input class="form-control" name="password" type="password" placeholder="Password"
                                id="passwordInput" />
                            <div class="invalid-feedback">Password wajib diisi.</div>
                        </div>

                        <!-- Remember me -->
                        <div class="mb-3 position-relative form-group">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="rememberCheck"
                                    name="rememberCheck" />
                                <label class="form-check-label" for="rememberCheck">Ingat saya</label>
                            </div>
                        </div>

                        <!-- Login Button -->
                        <button type="submit" class="btn btn-lg btn-primary w-100 mb-3" id="loginBtn">
                            <span id="btnText">Masuk Sekarang</span>
                            <span id="btnLoading" class="spinner-border spinner-border-sm d-none"></span>
                        </button>

                        <!-- Register Link -->
                        <div class="text-center mt-4">
                            <p class="text-muted mb-0">
                                Belum punya akun?
                                <a href="{{route ('auth.register')}}" class="text-primary text-decoration-none">Daftar
                                    di sini</a>
                            </p>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>


@endsection

@push('scripts')

<!-- untuk register berhasil atau tidak -->
@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        timer: 1800,
        showConfirmButton: false
    });
</script>
@endif

@if (session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: "{{ session('error') }}",
    });
</script>
@endif

<script>
    < script >
        document.addEventListener("DOMContentLoaded", function() {

            const form = document.getElementById("loginForm");

            form.addEventListener("submit", async function(e) {
                e.preventDefault();

                const email = form.querySelector("input[name='email']");
                const password = form.querySelector("input[name='password']");

                // --- VALIDASI EMAIL KOSONG ---
                if (!email.value.trim()) {
                    Swal.fire({
                        icon: "error",
                        title: "Email wajib diisi",
                        text: "Silakan masukkan email Anda.",
                        confirmButtonColor: "#3085d6",
                    });
                    return;
                }

                // --- VALIDASI PASSWORD KOSONG ---
                if (!password.value.trim()) {
                    Swal.fire({
                        icon: "error",
                        title: "Password wajib diisi",
                        text: "Silakan masukkan password Anda.",
                        confirmButtonColor: "#3085d6",
                    });
                    return;
                }

                // --- LOADING SAAT SUBMIT ---
                Swal.fire({
                    title: "Sedang memproses...",
                    text: "Mohon tunggu sebentar",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Delay sedikit agar UI loading tampil halus
                setTimeout(() => {
                    form.submit();
                }, 800);

            });

        }); <
    />
</script>

@endpush