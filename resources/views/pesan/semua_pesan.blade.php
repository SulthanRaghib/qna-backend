@include('layout.header')

<div class="px-3 py-3">
    <div class="d-flex justify-content-between pb-3">
        <a href="{{ route('pesan') }}" class="btn btn-primary fw-3 bg-ijo">Kirim Pesan</a>

        {{ $paginator->links('vendor.pagination.custom') }}
    </div>

    <table class="table table-hover" id="pesan-broadcast">
        <thead>
            <tr>
                <th scope="col">NO</th>
                <th scope="col">SUBJEK</th>
                <th scope="col">PERTANYAAN</th>
                {{-- <th scope="col">STATUS</th> --}}
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
    <script src="https://js.pusher.com/8.0.1/pusher.min.js"></script>
    <script>
        var pusher = new Pusher("{{ env('REVERB_APP_KEY') }}", {
            cluster: "",
            enabledTransports: ['ws'],
            forceTLS: false,
            wsHost: "127.0.0.1",
            wsPort: 8080,
        });

        var channel = pusher.subscribe("send-message");

        channel.bind("App\\Events\\PesanEvent", function(data) {
            console.log(data);
            var table = document.getElementById("pesan-broadcast").getElementsByTagName("tbody")[0];
            var row = table.insertRow(0);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);
            cell1.innerHTML = data.no;
            cell2.innerHTML = data.subjek;
            cell3.innerHTML = data.pertanyaan;
            cell4.innerHTML = data.status_id == 2 ? "<span class='badge bg-danger'>Belum dijawab</span>" : data
                .jawaban;
            cell5.innerHTML = data.tanggal_dibuat;
        });
    </script>
</div>

</body>

</html>
