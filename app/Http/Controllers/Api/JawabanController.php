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
        $sort = request()->input('sort', 'desc');

        $pesan = Pesan::with('status', 'user')->orderBy('tanggal_dibuat', $sort)->paginate(10);

        $jawaban = Jawaban::all();

        $data = $pesan->map(function ($value) use ($jawaban) {
            return [
                'id' => $value->id,
                'subjek' => $value->subjek,
                'pertanyaan' => $value->pertanyaan,
                'tanggal_dibuat' => Date::parse($value->tanggal_dibuat)->format('d/m/Y H:i'),
                'jawaban' => $jawaban->where('pesan_id', $value->id)->first()->jawaban ?? 'Belum Dibalas',
                'status' => $value->status->name,
                'user' => $value->user->username,
            ];
        });

        return response()->json([
            'message' => 'Berhasil menampilkan data',
            'data' => $data,
            'pagination' => [
                'current_page' => $pesan->currentPage(),
                'last_page' => $pesan->lastPage(),
                'per_page' => $pesan->perPage(),
                'total' => $pesan->total(),
                'next_page_url' => $pesan->nextPageUrl(),
                'prev_page_url' => $pesan->previousPageUrl()
            ]
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
