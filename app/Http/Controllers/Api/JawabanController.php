<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Jawaban;
use App\Models\Pesan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class JawabanController extends Controller
{
    public function sendMessage($id, Request $request)
    {
        $findPesan = Pesan::find($id);

        $request->validate([
            'jawaban' => 'required'
        ]);

        if ($findPesan->status_id == 1) {
            return response()->json([
                'message' => 'Pesan sudah dijawab'
            ], 400);
        }

        $jawaban = Jawaban::create([
            'jawaban' => $request->jawaban,
            'pesan_id' => $id,
            'user_id' => 1
        ]);

        $findPesan->update([
            'status_id' => 1
        ]);

        return response()->json([
            'message' => 'Jawaban untuk pesan ID: ' . $id . ' berhasil dikirim',
            'data' => $jawaban
        ], 201);
    }

    public function getPesanJawaban()
    {
        $pesan = Pesan::with('status', 'user')->get();
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

        return response()->json([
            'message' => 'Berhasil menampilkan data',
            'data' => $data
        ], 200);
    }

    public function updatePesanJawaban(Request $request, $id)
    {
        $findPesan = Pesan::find($id);
        $findJawaban = Jawaban::where('pesan_id', $id)->first();

        $request->validate([
            'jawaban' => 'required'
        ]);

        if ($findPesan->status_id == 2) {
            return response()->json([
                'message' => 'Pesan ID: ' . $id . ' belum dijawab, mohon kirim Jawabannya dulu woi'
            ], 400);
        }

        $findJawaban->update([
            'jawaban' => $request->jawaban
        ]);

        return response()->json([
            'message' => 'Jawaban untuk pesan ID: ' . $id . ' berhasil diupdate',
            'data' => $findJawaban
        ], 200);
    }
}
