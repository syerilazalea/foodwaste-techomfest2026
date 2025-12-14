@extends('auth.layouts.app')

@push('styles')

<style>
    .invalid-feedback {
        display: none;
    }

    .is-invalid~.invalid-feedback {
        display: block;
    }

    /* Hanya untuk tampilan < 992px */
@media (max-width: 991.98px) {
    /* Wrapper agar flex center vertical & horizontal */
    .col-12.col-lg-auto {
        display: flex !important;
        justify-content: center;
        align-items: center;
        height: 100vh !important; /* full height layar */
        padding: 0 !important;
    }

    /* Card utama */
    .login-card {
        min-height: auto !important;
        width: 90% !important;      /* sesuaikan lebar card di mobile */
        max-width: 360px;            /* tetap compact */
        justify-content: center !important;
        align-items: center !important;
        padding: 0 !important;
        margin: 0 auto !important;
        background-color: #fff;      /* background card utama */
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
        border-radius: 1rem !important;         /* tambahkan border radius untuk semua sudut */
    }

    /* Inner wrapper */
    .login-card-inner {
        width: 100% !important;       /* full width sesuai parent */
        padding: 1.5rem;
        background-color: transparent !important; /* hilangkan card putih tambahan */
        border-radius: inherit;        /* mengikuti border-radius parent */
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

        <!-- Login Card -->
        <div class="col-12 col-lg-auto h-100 pb-2 px-4 pt-0 p-lg-0">
            <div class="sw-lg-70 min-h-100 bg-foreground d-flex justify-content-center align-items-center shadow-deep py-5 full-page-content-right-border login-card">
                <div class="sw-lg-50 w-100 login-card-inner">
                    <form id="loginForm" class="tooltip-end-bottom" method="POST" action="{{ route('auth.login.store') }}">
                        @csrf
                        <!-- Title -->
                        <div class="mb-4 text-center">
                            <h2 class="display-6 fw-bold">Masuk ke Econect</h2>
                            <p class="text-muted mt-1">Akses akun Anda untuk melanjutkan</p>
                        </div>

                        <!-- Email -->
                        <div class="mb-3 filled form-group tooltip-end-top">
                            <i data-acorn-icon="email"></i>
                            <input class="form-control" placeholder="Email" name="email" type="email" id="emailInput" required/>
                            <div class="invalid-feedback">Email wajib diisi.</div>
                        </div>

                        <!-- Password -->
                        <div class="mb-3 filled form-group tooltip-end-top">
                            <i data-acorn-icon="lock-on"></i>
                            <input class="form-control" name="password" type="password" placeholder="Password" id="passwordInput" required />
                            <div class="invalid-feedback">Password wajib diisi.</div>
                        </div>

                        <!-- Login Button -->
                        <button type="submit" class="btn btn-lg btn-primary w-100 mb-3" id="loginBtn">
                            <span id="btnText">Masuk Sekarang</span>
                            <span id="btnLoading" class="spinner-border spinner-border-sm d-none"></span>
                        </button>

                        <!-- Register Link -->
                        <div class="text-center mt-3">
                            <p class="text-muted mb-0">
                                Belum punya akun?
                                <a href="{{route ('auth.register')}}" class="text-primary text-decoration-none">Daftar di sini</a>
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
<script>
    document.addEventListener("DOMContentLoaded", function() {

        const form = document.getElementById("loginForm");

        form.addEventListener("submit", async function(e) {
            e.preventDefault();

            const email = form.querySelector("input[name='email']");
            const password = form.querySelector("input[name='password']");

            // Delay sedikit agar UI loading tampil halus
            setTimeout(() => {
                form.submit();
            }, 800);

        });

    });
</script>

@endpush