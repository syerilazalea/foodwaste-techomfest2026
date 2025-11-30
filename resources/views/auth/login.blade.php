@extends('auth.layouts.app')

@section('content')

<div class="container-fluid p-0 h-100 position-relative">
    <div class="row g-0 h-100">
        <div class="offset-0 col-12 d-none d-lg-flex offset-md-1 col-lg h-lg-100">
            <div class="min-h-100 d-flex align-items-center">
                <div class="w-100 w-lg-75 w-xxl-50">
                    <div>
                        <div>
                            <div class="mb-5">
                                <h1 class="display-3 text-white">Food Cycle</h1>
                                <h1 class="display-6 text-white">Reduce Food Waste Together</h1>
                            </div>
                            <p class="h6 text-white lh-1-6 mb-5">
                                Bersama, kita membangun ekosistem yang lebih berkelanjutan.
                                Melalui layanan ini, Anda dapat menyalurkan makanan berlebih kepada sesama,
                                menerima makanan dari komunitas, serta membagikan limbah makanan atau bahan
                                pangan yang sudah tidak layak konsumsi untuk diolah menjadi kompos.
                            </p>
                            <div class="mb-5">
                                <a class="btn btn-lg btn-outline-white" href="home.html">Pelajari Lebih
                                    Lanjut</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-auto h-100 pb-2 px-4 pt-0 p-lg-0">
                <div
                    class="sw-lg-70 min-h-100 bg-foreground d-flex justify-content-center align-items-center shadow-deep py-5 full-page-content-right-border">
                    <div class="sw-lg-50">
                        <div>
                            <form id="loginForm" class="tooltip-end-bottom" method="POST" action="{{ route('auth.login.store') }}">
                                @csrf
                                <!-- Title -->
                                <div class="mb-5 text-center">
                                    <h2 class="display-5 fw-bold">Masuk ke Food Cycle</h2>
                                    <p class="text-muted mt-2">Akses akun Anda untuk melanjutkan</p>
                                </div>

                                <!-- Email -->
                                <div class="mb-3 filled form-group tooltip-end-top">
                                    <i data-acorn-icon="email"></i>
                                    <input class="form-control" placeholder="Email" name="email"
                                        type="email" required />
                                </div>

                                <!-- Password -->
                                <div class="mb-3 filled form-group tooltip-end-top">
                                    <i data-acorn-icon="lock-on"></i>
                                    <input class="form-control" name="password" type="password"
                                        placeholder="Password" required />
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
                                <button type="submit" class="btn btn-lg btn-primary w-100 mb-3">
                                    Masuk Sekarang
                                </button>

                                <!-- Divider -->
                                <div class="text-center position-relative my-4">
                                    <hr>
                                    <span
                                        class="bg-foreground px-3 position-absolute top-50 start-50 translate-middle text-muted">
                                        atau
                                    </span>
                                </div>

                                <!-- Google Login -->
                                <button type="button" id="googleSignIn"
                                    class="btn btn-outline-secondary w-100 d-flex align-items-center justify-content-center gap-3 py-2">
                                    <svg width="18" height="18" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 48 48">
                                        <path fill="#FFC107"
                                            d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z" />
                                        <path fill="#FF3D00"
                                            d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z" />
                                        <path fill="#4CAF50"
                                            d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z" />
                                        <path fill="#1976D2"
                                            d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z" />
                                    </svg>
                                    <span>Masuk dengan Google</span>
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
    </div>
</div>

@endsection

@push('scripts')
@if ($errors->has('loginError'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        swal({
            title: "Login Gagal",
            text: "{{ $errors->first('loginError') }}",
            icon: "error",
            button: "Oke"
        });
    });
</script>
@endif

@endpush