<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Jawaban;
use App\Models\Pesan;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class PesanController extends Controller
{
    public function index()
    {
        return view('pesan.kirim_pesan', [
            'title' => 'Pesan'
        ]);
    }

    public function kirim_pesan(Request $request)
    {
        $validateData = $request->validate([
            'pertanyaan' => 'required'
        ], [
            'pertanyaan.required' => 'Pesan tidak boleh kosong'
        ]);

        $tambahPesan = [
            'subjek' => 'No Subject',
            'pertanyaan' => $validateData['pertanyaan'],
            'user_id' => '2',
            'status_id' => '2',
            'tanggal_dibuat' => now()
        ];

        Pesan::create($tambahPesan);

        return redirect()->route('pesan')->with('success', 'Pesan berhasil dikirim');
    }

    public function get_semua_pesan()
    {
        $pesan = Pesan::with('status', 'user')->orderBy('tanggal_dibuat', 'desc')->paginate(10);
        $jawaban = Jawaban::with('pesan')->get();

        $data = [];

        foreach ($pesan as $key => $value) {
            $data[$key]['id'] = $value->id;
            $data[$key]['subjek'] = $value->subjek;
            $data[$key]['pertanyaan'] = $value->pertanyaan;
            $data[$key]['tanggal_dibuat'] = Date::parse($value->tanggal_dibuat)->format('d F Y H:i:s');
            $data[$key]['jawaban'] = $jawaban->where('pesan_id', $value->id)->first()->jawaban ?? "Belum Dibalas";
            $data[$key]['user'] = $value->user->username;
        }


        return view('pesan.semua_pesan', [
            'title' => 'Semua Pesan',
            'data' => $data,
            'paginator' => $pesan->withQueryString()
        ]);
    }
}
