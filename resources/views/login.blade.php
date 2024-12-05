@include('layout.header')
@if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '{{ session('error') }}',
            showConfirmButton: false,
            timer: 2000
        })
    </script>
@endif
@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 2000
        })
    </script>
@endif

<div class="d-flex flex-row">
    <div class="col-6 position-relative">
        <!-- Gambar Background -->
        <img src="{{ asset('assets/img/bg-login.png') }}" alt="bg-login" class="img-fluid d-flex align-items-stretch w-100"
            style="height: 100vh;">

        <!-- Konten Tengah -->
        <div class="position-absolute top-50 start-0 translate-middle-y px-5" style="z-index: 2;">
            <div class="d-flex flex-column">
                <h1 class="fw-bold text-white fz-60 mb-4">Sampaikan Keluhanmu Disini</h1>
                <p class="card-text text-white">Kami menjamin privasimu, sampaikan keluhan, masukan, atau kritik yang
                    membangun.</p>
            </div>
        </div>

        <!-- Gambar User -->
        <div class="position-absolute bottom-0 start-50 translate-middle-x" style="z-index: 1;">
            <img src="{{ asset('assets/img/user.png') }}" alt="logo" class="img-fluid" style="max-width: 540px;">
        </div>
    </div>
    <div class="col-6 position-relative">

        <div class="position-absolute top-50 start-50 translate-middle" style="z-index: 2;">

            {{-- buat form login di tengah --}}
            <form action="{{ route('login.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label fw-medium">Email</label>
                    <input type="email" class="form-control py-3" id="email" name="email" placeholder="email"
                        style="width: 480px;" value="{{ old('email') }}">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label fw-medium">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control py-3" id="password" name="password"
                            placeholder="password" value="{{ old('password') }}">
                        <span class="input-group-text" style="cursor: pointer"><i class="bi bi-eye-slash"
                                id="toggle-password"></i></span>
                    </div>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class=" d-flex justify-content-between">
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                    <div>
                        <a href="#" class="text-decoration-none color-ijo ms-3">Lupa Password</a>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary py-3 fw-medium"
                    style="width:160px; background:#2CA691">Login
                </button>
            </form>
        </div>
    </div>
</div>
</div>
<!-- Custom JS for Toggle Password Visibility -->
<script>
    const togglePassword = document.getElementById('toggle-password');
    const passwordInput = document.getElementById('password');

    togglePassword.addEventListener('click', function() {
        // Toggle password visibility
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            togglePassword.classList.remove('bi-eye-slash');
            togglePassword.classList.add('bi-eye');
        } else {
            passwordInput.type = 'password';
            togglePassword.classList.remove('bi-eye');
            togglePassword.classList.add('bi-eye-slash');
        }
    });
</script>
</body>

</html>
