@extends('auth.layouts.app')

@section('content')

<div class="container-fluid p-0 h-100 position-relative">
    <div class="row g-0 h-100">
        <!-- Left Side Start -->
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
                                Bersama, kita membangun ekosistem yang lebih berkelanjutan. Melalui layanan ini, Anda dapat menyalurkan makanan berlebih kepada sesama, menerima makanan dari komunitas, serta membagikan limbah makanan atau bahan pangan yang sudah tidak layak konsumsi
                                untuk diolah menjadi kompos.
                            </p>
                            <div class="mb-5">
                                <a class="btn btn-lg btn-outline-white" href="#home">Pelajari Lebih
                                    Lanjut</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Left Side End -->

            <!-- Right Side Start -->
            <div class="col-12 col-lg-auto h-100 pb-2 px-4 pt-0 p-lg-0">
                <div class="sw-lg-70 min-h-100 bg-foreground d-flex justify-content-center align-items-center shadow-deep py-5 full-page-content-right-border">
                    <div class="sw-lg-50">
                        <div>
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

                                <!-- Divider -->
                                <div class="text-center position-relative my-4">
                                    <hr>
                                    <span class="bg-foreground px-3 position-absolute top-50 start-50 translate-middle text-muted">
                                        atau
                                    </span>
                                </div>

                                <!-- Google Sign In Button -->
                                <button type="button" id="googleSignIn" class="btn btn-outline-secondary w-100 d-flex align-items-center justify-content-center gap-3 py-2">
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
                                    <span>Daftar dengan Google</span>
                                </button>

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

    document.addEventListener('DOMContentLoaded', function() {
        // Elements
        const radios = document.querySelectorAll('input[name="role"]');
        const userRoleInput = document.getElementById('userRole');
        const pegiatFields = document.getElementById('aktivisFields');
        const userFields = document.getElementById('userFields');
        const roleError = document.getElementById('roleError');
        const registerForm = document.getElementById('registerForm');
        const googleSignInBtn = document.getElementById('googleSignIn');


        // Role selection functionality

        radios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === "user") {
                    userFields.classList.remove("d-none");
                    pegiatFields.classList.add("d-none");
                } else if (this.value === "aktivis") {
                    pegiatFields.classList.remove("d-none");
                    userFields.classList.add("d-none");
                }
            });
        });
        // Form validation for manual registration
        registerForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Check if role is selected
            if (!userRoleInput.value) {
                roleError.textContent = 'Silakan pilih peran Anda';
                return;
            }

            // Check password match
            const password = this.querySelector('input[name="registerPassword"]').value;
            const confirmPassword = this.querySelector('input[name="registerConfirmPassword"]')
                .value;

            if (password !== confirmPassword) {
                alert('Password dan konfirmasi password tidak sama!');
                return;
            }

            // Check terms and conditions
            const termsCheck = this.querySelector('#registerCheck');
            if (!termsCheck.checked) {
                alert('Anda harus menyetujui syarat dan ketentuan!');
                return;
            }

            // If all validations pass
            const roleName = userRoleInput.value === 'aktivis' ? 'Aktivis Lingkungan' :
                'Kontributor';
            alert(`Pendaftaran sebagai ${roleName} berhasil!\nData akan diproses.`);

            // Here you would typically send data to your backend
            console.log('Form data:', {
                role: userRoleInput.value,
                name: this.querySelector('input[name="registerName"]').value,
                email: this.querySelector('input[name="registerEmail"]').value,
                phone: this.querySelector('input[name="registerPhone"]').value
            });

            // this.submit(); // Uncomment to actually submit the form
        });

        // Google Sign In functionality
        if (googleSignInBtn) {
            googleSignInBtn.addEventListener('click', function() {
                // Check if role is selected for Google sign up
                if (!userRoleInput.value) {
                    roleError.textContent =
                        'Silakan pilih peran Anda sebelum mendaftar dengan Google';
                    return;
                }

                // Initialize Google Sign In
                initGoogleSignIn();
            });
        }

        function initGoogleSignIn() {
            // For demo purposes - in real implementation, you would use Google Identity Services
            const role = userRoleInput.value;
            const roleName = role === 'aktivis' ? 'Aktivis Lingkungan' : 'Kontributor';

            // Simulate Google Sign In process
            alert(
                `Mengarahkan ke Google Sign In...\n\nSetelah login dengan Google, Anda akan terdaftar sebagai ${roleName}`
            );

            // Simulate successful Google sign in
            setTimeout(() => {
                const userData = {
                    role: role,
                    method: 'google',
                    name: 'User Google', // This would come from Google API
                    email: 'user@gmail.com', // This would come from Google API
                    verified: true
                };

                console.log('Google registration data:', userData);
                alert(
                    `Pendaftaran dengan Google berhasil!\nAnda terdaftar sebagai ${roleName}`
                );

                // Redirect or proceed with registration
                // window.location.href = 'dashboard.html';
            }, 2000);
        }

        // Add some basic styling for the custom control containers
        const style = document.createElement('style');
        style.textContent = `
            .custom-control-container {
                display: flex;
                align-items: center;
                gap: 10px;
                padding: 12px;
                border: 2px solid #e9ecef;
                border-radius: 8px;
                transition: all 0.3s ease;
                cursor: pointer;
            }
            .custom-control-container:hover {
                border-color: #007bff;
                background-color: rgba(0, 123, 255, 0.05);
            }
            .custom-control-container .form-check {
                margin-bottom: 0;
                flex-grow: 1;
            }
            .form-check-input:checked ~ .custom-control-container {
                border-color: #007bff;
                background-color: rgba(0, 123, 255, 0.05);
            }
            #googleSignIn {
                border: 1px solid #ddd;
                background: white;
                color: #333;
                transition: all 0.3s ease;
            }
            #googleSignIn:hover {
                border-color: #4285f4;
                background-color: rgba(66, 133, 244, 0.05);
            }
        `;
        document.head.appendChild(style);
    });
</script>
<!-- Page Specific Scripts End -->

@endpush