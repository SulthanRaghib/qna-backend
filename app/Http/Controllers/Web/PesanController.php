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
            'subjek' => $request->subjek ?? 'No Subject',
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

    public function hapus_pesan($id)
    {
        Jawaban::where('pesan_id', $id)->delete();
        Pesan::where('id', $id)->delete();

        return redirect()->route('kontak.masuk')->with('success-delete', 'Pesan ID ' . $id . ' berhasil dihapus');
    }

    public function kirim_reply(Request $request)
    {
        // Validasi input balasan
        $request->validate([
            'jawaban' => 'required|string|max:255' // Pastikan jawaban tidak kosong dan maksimal 255 karakter
        ], [
            'jawaban.required' => 'Jawaban tidak boleh kosong',
            'jawaban.string' => 'Jawaban harus berupa teks',
            'jawaban.max' => 'Jawaban tidak boleh lebih dari 255 karakter'
        ]);

        // Temukan pesan berdasarkan ID
        $getIDPesan = Pesan::find($request->pesan_id);
        $insertJawaban = [
            'pesan_id' => $request->pesan_id,
            'jawaban' => $request->jawaban,
            'user_id' => $request->user_id,
        ];

        // Jika pesan ditemukan, maka tambahkan jawaban
        if ($getIDPesan) {
            Jawaban::create($insertJawaban);
            Pesan::where('id', $request->pesan_id)->update(['status_id' => 1]);
            return redirect()->route('kontak.masuk')->with('success-reply', 'Jawaban berhasil dikirim');
        } else {
            return redirect()->route('kontak.masuk')->with('error', 'Pesan tidak ditemukan');
        }
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'subjek' => 'required',
            'pertanyaan' => 'required',
            'jawaban' => 'nullable'
        ]);

        // Cari data pesan berdasarkan ID
        $pesan = Pesan::findOrFail($id);
        $jawaban = Jawaban::where('pesan_id', $id)->first();

        // Perbarui data pesan
        $pesan->update([
            'subjek' => $validatedData['subjek'],
            'pertanyaan' => $validatedData['pertanyaan'],
            'user_id' => $request->user_id,
        ]);

        $jawaban->update([
            'jawaban' => $validatedData['jawaban']
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('kontak.masuk')->with('success-update', 'Pesan berhasil diperbarui!');
    }
}
