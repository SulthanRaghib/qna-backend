@extends('main')
@section('content')
    @if (session('success'))
        <script>
            Swal.fire({
                title: "Ohayoo!",
                text: "Selamat datang {{ Auth::user()->username }}",
                icon: "success"
            });
        </script>
    @endif
    @if (session('success-delete'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: "{{ session('success-delete') }}",
                showConfirmButton: false,
                timer: 1000
            });
        </script>
    @endif
    @if (session('success-reply'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: "{{ session('success-reply') }}",
                showConfirmButton: false,
                timer: 1000
            });
        </script>
    @endif
    @if (session('success-update'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: "{{ session('success-update') }}",
                showConfirmButton: false,
                timer: 1000
            });
        </script>
    @endif

    {{-- BUAT REPLY --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const replyButtons = document.querySelectorAll('.btn-reply');

            replyButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Ambil data dari tombol
                    const id = this.getAttribute('data-id');
                    const subject = this.getAttribute('data-subject');
                    const question = this.getAttribute('data-question');

                    // Masukkan data ke modal
                    document.getElementById('pesanId').value = id;
                    document.getElementById('replySubject').textContent = subject;
                    document.getElementById('replyQuestion').textContent = question;
                });
            });
        });
    </script>

    <div class="container">
        <div class="">
            {{-- <h3 class="fw-bold mb-3">DataTables.Net</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="#">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Tables</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Datatables</a>
                </li>
            </ul> --}}
            <div class="d-flex justify-content-between pb-3">
                <a href="{{ route('pesan') }}" class="btn btn-primary fw-3 bg-ijo">Kirim Pesan</a>

                {{ $paginator->links('vendor.pagination.custom') }}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">NO</th>
                            <th scope="col">
                                <input type="checkbox" class="form-check-input"
                                    style="cursor: pointer; width: 16px; height: 16px">
                            </th>
                            <th scope="col">SUBJEK</th>
                            <th scope="col">PERTANYAAN</th>
                            <th scope="col">JAWABAN</th>
                            <th scope="col">TANGGAL
                                @php
                                    $newSort = request('sort') == 'asc' ? 'desc' : 'asc';
                                @endphp
                                <a href="{{ route('dashboard', ['sort' => $newSort]) }}" class="text-decoration-none">
                                    <i
                                        class="{{ request('sort') == 'asc' ? 'bi bi-caret-up-fill text-dark' : 'bi bi-caret-up' }}"></i>
                                </a>
                                <a href="{{ route('dashboard', ['sort' => $newSort]) }}" class="text-decoration-none">
                                    <i
                                        class="{{ request('sort') == 'desc' ? 'bi bi-caret-down-fill text-dark' : 'bi bi-caret-down' }}"></i>
                                </a>
                            </th>
                            <th scope="col">STATUS</th>
                            <th scope="col">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                            <tr>
                                <th scope="row">{{ $paginator->firstItem() + $key }}</th>
                                <td>
                                    <input type="checkbox" class="form-check-input"
                                        style="cursor: pointer; width: 16px; height: 16px">
                                </td>
                                <td>{{ $item['subjek'] }}</td>
                                <td>{{ $item['pertanyaan'] }}</td>
                                <td>
                                    @if ($item['jawaban'] == 'Belum Dibalas')
                                        <span class="badge bg-danger">Belum dijawab</span>
                                    @else
                                        {{ $item['jawaban'] }}
                                    @endif
                                </td>
                                <td>{{ $item['tanggal_dibuat'] }}</td>
                                <td>
                                    @if ($item['status'] == 'Sudah Dibalas')
                                        <span class="badge bg-success-custom"
                                            style="color: #119c2b; border:none; font-size:14px"><i
                                                class="bi bi-check2 pr-3 w-3"></i> Sudah
                                            Dijawab</span>
                                    @else
                                        <span class="badge bg-secondary-custom" style="color: #757575; font-size:14px">Belum
                                            Dibalas</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        @if ($item['status'] == 'Sudah Dibalas')
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $item['id'] }}">
                                                <i class="bi bi-pencil-fill" style="color: #757575; font-size:16px"></i>
                                            </a>
                                        @else
                                            <a href="javascript:void(0)" class="btn-reply" data-bs-toggle="modal"
                                                data-bs-target="#replyModal" data-id="{{ $item['id'] }}"
                                                data-subject="{{ $item['subjek'] }}"
                                                data-question="{{ $item['pertanyaan'] }}">
                                                <i class="bi bi-reply-fill" style="color: #757575; font-size:16px"></i>
                                            </a>
                                        @endif
                                        <form action="{{ route('pesan.delete', $item['id']) }}" method="POST"
                                            class="form-delete">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" style="background: none; border: none" class="btn-delete"
                                                style="color: #757575; font-size:16px"><i
                                                    class="bi bi-trash-fill"></i></button>
                                        </form>
                                    </div>
                                    <script>
                                        // Seleksi semua tombol hapus
                                        document.querySelectorAll('.btn-delete').forEach(button => {
                                            button.addEventListener('click', function(e) {
                                                e.preventDefault(); // Mencegah form langsung terkirim

                                                // Ambil form terdekat dari tombol
                                                const form = this.closest('.form-delete');

                                                // Tampilkan SweetAlert
                                                Swal.fire({
                                                    title: 'Apakah Anda yakin?',
                                                    text: "Pesan ini akan dihapus secara permanen!",
                                                    icon: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonColor: '#d33',
                                                    cancelButtonColor: '#3085d6',
                                                    confirmButtonText: 'Ya, Hapus!',
                                                    cancelButtonText: 'Batal'
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        // Submit form jika dikonfirmasi
                                                        form.submit();
                                                    }
                                                });
                                            });
                                        });
                                    </script>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fixed-bottom-right fade" id="replyModal" tabindex="-1" aria-labelledby="replyModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title" id="replyModalLabel">Pesan Baru</h5>
                        <div data-bs-theme="dark">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><span id="replySubject"></span></li>
                        <li class="list-group-item"><span id="replyQuestion"></span></li>
                        <li class="list-group-item">
                            <form action="{{ route('pesan.reply.submit') }}" method="POST">
                                @csrf
                                <input type="hidden" name="pesan_id" id="pesanId">
                                @if (Auth::check())
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                @endif
                                <div class="mb-3">
                                    <label for="replyText" class="form-label">Tulis Balasan</label>
                                    <textarea class="form-control" id="replyText" name="jawaban" rows="10" cols="100" style="resize: none;"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Kirim</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        @foreach ($data as $item)
            <div class="modal fixed-bottom-right fade" id="editModal{{ $item['id'] }}" tabindex="-1"
                aria-labelledby="editModalLabel{{ $item['id'] }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-dark text-white">
                            <h5 class="modal-title" id="editModalLabel{{ $item['id'] }}">Edit Pesan</h5>
                            <div data-bs-theme="dark">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            </div>
                        </div>
                        <form action="{{ route('pesan.update', $item['id']) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="mb-3">
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <label for="subjek{{ $item['id'] }}" class="form-label">Subjek</label>
                                    <input type="text" class="form-control" id="subjek{{ $item['id'] }}"
                                        name="subjek" value="{{ $item['subjek'] }}">
                                </div>
                                <div class="mb-3">
                                    <label for="pertanyaan{{ $item['id'] }}" class="form-label">Pertanyaan</label>
                                    <textarea class="form-control" id="pertanyaan{{ $item['id'] }}" name="pertanyaan" rows="3"
                                        style="resize: none;">{{ $item['pertanyaan'] }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="jawaban{{ $item['id'] }}" class="form-label">Jawaban</label>
                                    <textarea class="form-control" id="jawaban{{ $item['id'] }}" name="jawaban" rows="3"
                                        style="resize: none;">{{ $item['jawaban'] }}</textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach


    </div>
@endsection
