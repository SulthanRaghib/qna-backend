@extends('main')
@section('content')
    <script type="text/javascript">
        window.onload = function() {
            CanvasJS.addColorSet("customGreen", [
                "#2CA691"
            ]);
            var chart = new CanvasJS.Chart("chartContainer", {
                title: {
                    text: "Top Oil Reserves"
                },
                colorSet: "customGreen",
                animationEnabled: true,

                data: [

                    {
                        dataPoints: [{
                                x: 1,
                                y: 297571,
                                label: "Venezuela"
                            },
                            {
                                x: 2,
                                y: 267017,
                                label: "Saudi"
                            },
                            {
                                x: 3,
                                y: 175200,
                                label: "Canada"
                            },
                            {
                                x: 4,
                                y: 154580,
                                label: "Iran"
                            },
                            {
                                x: 5,
                                y: 116000,
                                label: "Russia"
                            },
                            {
                                x: 6,
                                y: 97800,
                                label: "UAE"
                            },
                            {
                                x: 7,
                                y: 20682,
                                label: "US"
                            },
                            {
                                x: 8,
                                y: 20350,
                                label: "China"
                            }
                        ]
                    }
                ]
            });

            chart.render();
        }
    </script>
    <script type="text/javascript" src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

    <div class="container">
        <div class="position-relative">
            <div class="card bg-ijo-linear w-100 mt-5">
                <div class="card-body" style="height: 175px">
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
                <h1>Laravel ChartJS Chart Example - ItSolutionStuff.com</h1>

                <div id="chartContainer" style="height: 300px; width: 100%;"></div>

                <div class="col-4">

                </div>
            </div>
        </div>
    @endsection
