@include('layout.header')

<div class="px-3 py-3">
    <div class="d-flex justify-content-between pb-3">
        <a href="{{ route('pesan') }}" class="btn btn-primary fw-3 bg-ijo">Kirim Pesan</a>

        {{ $paginator->links('vendor.pagination.custom') }}
    </div>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">NO</th>
                <th scope="col">SUBJEK</th>
                <th scope="col">PERTANYAAN</th>
                <th scope="col">JAWABAN</th>
                <th scope="col">TANGGAL</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $item)
                <tr>
                    <th scope="row">{{ $paginator->firstItem() + $key }}</th>
                    <td class="fw-bold">{{ $item['subjek'] }}</td>
                    <td>{{ $item['pertanyaan'] }}</td>
                    <td>
                        @if ($item['jawaban'] == 'Belum Dibalas')
                            <span class="badge bg-danger">Belum dijawab</span>
                        @else
                            {{ $item['jawaban'] }}
                        @endif
                    <td>{{ $item['tanggal_dibuat'] }}</td>
                </tr>
            @endforeach

        </tbody>

    </table>
</div>

</body>

</html>
