@extends('main')
@section('content')
    <script type="text/javascript">
        window.onload = function() {
            CanvasJS.addColorSet("customGreen", [
                "#2CA691"
            ]);
            var totalPesan = @json($totalPesan);
            var chart = new CanvasJS.Chart("chartContainer", {
                title: {
                    text: ""
                },
                colorSet: "customGreen",
                animationEnabled: true,
                axisX: {
                    interval: 1, // Pastikan semua bulan ditampilkan
                    labelFontSize: 12 // Ukuran font label
                },
                data: [{
                    dataPoints: Object.keys(totalPesan).map(function(bulan) {
                        return {
                            x: parseInt(bulan), // Angka bulan
                            y: totalPesan[bulan], // Total pesan (0 jika tidak ada data)
                            label: new Date(0, bulan - 1).toLocaleString('id-ID', {
                                month: 'long'
                            }) // Nama bulan
                        };
                    })
                }]
            });

            chart.render();
        }
    </script>
    <script type="text/javascript" src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

    <div class="container">
        <div class="position-relative">
            <div class="card bg-ijo-linear w-100 mt-5">
                <div class="card-body d-flex flex-column justify-content-center" style="height: 175px">
                    <h1 class="text-white fw-bold">Statistik Pesan</h1>
                    <p class="card-text text-white" style="width: 532px">Cek statistik pesan disini. Pastikan admin dapat
                        membalas dan memberikan
                        solusi terhadap
                        keluhan semua karyawan!</p>
                </div>
                <div class="position-absolute top-50 end-0 translate-middle-y" style="padding-bottom: 0">
                    <img src="{{ url('assets/img/statistik.png') }}" alt="img-statistik" style="width: 100%">
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-8">
                <div class="card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2>Statistik Total Pesan</h2>

                        <div class="d-flex gap-3">
                            <i class="bi bi-chevron-left"></i>
                            2024
                            <i class="bi bi-chevron-right"></i>
                        </div>
                    </div>

                    <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                </div>
            </div>

            <div class="col-4">
                <div class="card p-4">
                    <div class="card mb-4" style="background: #E0F2EF">
                        <div class="row g-0 align-items-center">
                            <div class="col-md-5">
                                <h1 class="p-4 fs-3">Semua Pesan</h1>
                            </div>
                            <div class="col-md-7">
                                <h1 class="fw-bold" style="font-size: 48px; color:#2CA691">{{ $totalSemuaPesan }}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4" style="background: #E0F2EF">
                        <div class="row g-0 align-items-center">
                            <div class="col-md-5">
                                <h1 class="p-4 fs-3">Pesan Dibalas</h1>
                            </div>
                            <div class="col-md-7">
                                <h1 class="fw-bold" style="font-size: 48px; color:#2CA691">{{ $totalPesanDibalas }}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-0" style="background: #E0F2EF">
                        <div class="row g-0 align-items-center">
                            <div class="col-md-5">
                                <h1 class="p-4 fs-3">Belum Dibalas</h1>
                            </div>
                            <div class="col-md-7">
                                <h1 class="fw-bold" style="font-size: 48px; color:#2CA691">{{ $totalPesanBelumDibalas }}
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
