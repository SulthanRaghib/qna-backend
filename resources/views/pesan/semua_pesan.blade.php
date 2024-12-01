@include('layout.header')

<div class="px-3 py-3">
    <div class="d-flex justify-content-between pb-3">
        <a href="{{ route('pesan') }}" class="btn btn-primary fw-3 bg-ijo">Kirim Pesan</a>

        {{ $paginator->links('vendor.pagination.custom') }}
    </div>

    <table class="table">
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
                    <td>{{ $item['subjek'] }}</td>
                    <td>{{ $item['pertanyaan'] }}</td>
                    <td>{{ $item['jawaban'] }}</td>
                    <td>{{ $item['tanggal_dibuat'] }}</td>
                </tr>
            @endforeach

        </tbody>

    </table>
</div>

</body>

</html>
