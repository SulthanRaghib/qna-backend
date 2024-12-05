@include('layout.header')

<div class="d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="card border-white">
        <div class="card-body d-flex flex-column align-items-center">
            <h5 class="card-title-message">QnA Infidea</h5>
            <h3 class="card-title fz-36 pb-3">Sampaikan Keluhanmu Disini</h3>
            <p class="card-text-message mb-5">Kami menjamin privasimu, sampaikan keluhan, masukan, atau kritik yang
                membangun.
            </p>
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
            <form action="{{ route('pesan.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="mb-3">
                    <label for="subjek" class="form-label fw-medium">Subjek</label>
                    <input type="text" class="form-control py-3" id="subjek" name="subjek"
                        placeholder="topik pesanmu">
                    @error('subjek')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="pertanyaan" class="form-label fw-medium">Pertanyaan</label>
                    <textarea class="form-control pt-2" id="pertanyaan" name="pertanyaan" placeholder="tulis pesanmu disini"
                        style="resize: none;" rows="5"></textarea>
                    @error('pertanyaan')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary py-3 fw-medium"
                    style="width: 480px; background:#2CA691">Kirim
                    Pesanmu</button>
            </form>

            <a href="{{ route('pesan.all') }}" class="text-decoration-none color-ijo mt-5 fw-medium"> Cek Semua Pesan <i
                    class="bi bi-arrow-right"></i></a>
        </div>
    </div>
</div>

</body>

</html>
