<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Jawaban;
use App\Models\Pesan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class DashboardController extends Controller
{
    public function index()
    {
        $sort = request()->input('sort', 'desc');
        $pesan = Pesan::with('status', 'user')->orderBy('tanggal_dibuat', $sort)->paginate(10);
        $jawaban = Jawaban::with('pesan')->get();

        $data = [];

        foreach ($pesan as $key => $value) {
            $data[$key]['id'] = $value->id;
            $data[$key]['subjek'] = $value->subjek;
            $data[$key]['pertanyaan'] = $value->pertanyaan;
            $data[$key]['tanggal_dibuat'] = Date::parse($value->tanggal_dibuat)->format('d F Y H:i');
            $data[$key]['jawaban'] = $jawaban->where('pesan_id', $value->id)->first()->jawaban ?? "Belum Dibalas";
            $data[$key]['status'] = $value->status->name;
            $data[$key]['user'] = $value->user->username;
        }

        return view('kontak-masuk', [
            'title' => 'Kontak Masuk',
            'data' => $data,
            'paginator' => $pesan->withQueryString(),
            'sort' => $sort
        ]);
    }

    public function statistik()
    {
        // total pesan berdasarkan bulan
        $totalPesan = Pesan::selectRaw('MONTH(tanggal_dibuat) as bulan, COUNT(*) as total_pesan')
            ->groupBy('bulan')
            ->get();

        // Membuat array untuk semua bulan
        $bulanArray = [];
        for ($i = 1; $i <= 12; $i++) {
            $bulanArray[$i] = 0; // Set default 0 untuk setiap bulan
        }

        // Mengupdate array bulan dengan data yang ada
        foreach ($totalPesan as $pesan) {
            $bulanArray[$pesan->bulan] = $pesan->total_pesan;
        }

        $totalSemuaPesan = Pesan::count();
        $totalPesanDibalas = Jawaban::count();
        $totalPesanBelumDibalas = $totalSemuaPesan - $totalPesanDibalas;

        return view('statistik', [
            'title' => 'Statistik',
            'totalPesan' => $bulanArray,
            'totalSemuaPesan' => $totalSemuaPesan,
            'totalPesanDibalas' => $totalPesanDibalas,
            'totalPesanBelumDibalas' => $totalPesanBelumDibalas
        ]);
    }
}
