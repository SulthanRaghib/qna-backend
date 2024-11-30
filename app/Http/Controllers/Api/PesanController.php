<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PesanResource;
use App\Models\Jawaban;
use App\Models\Pesan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PesanController extends Controller
{
    public function index()
    {
        $pesans = Pesan::with(['status', 'user'])->get();
        $data = PesanResource::collection($pesans);

        return response()->json([
            'message' => 'Berhasil menampilkan data Pesan',
            'data' => $data
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subjek' => 'required',
            'pertanyaan' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
            ], 400);
        }

        $pesan = Pesan::create([
            'subjek' => $request->subjek,
            'pertanyaan' => $request->pertanyaan,
            'tanggal_dibuat' => now(),
            'status_id' => 2,
            'user_id' => 2
        ]);

        $data = new PesanResource($pesan);

        return response()->json([
            'message' => 'Data Pesan berhasil ditambahkan',
            'data' => $data
        ], 201);
    }

    public function show($id)
    {
        $pesan = Pesan::with(['status', 'user'])->find($id);

        if (!$pesan) {
            return response()->json([
                'message' => 'Data Pesan tidak ditemukan'
            ], 404);
        }

        $data = new PesanResource($pesan);

        return response()->json([
            'message' => 'Berhasil menampilkan data pesan ID: ' . $id,
            'data' => $data
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'subjek' => 'required',
            'pertanyaan' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
            ], 400);
        }

        $pesan = Pesan::find($id);

        if (!$pesan) {
            return response()->json([
                'message' => 'Data pesan ID: ' . $id . ' tidak ditemukan'
            ], 404);
        }

        $pesan->update([
            'subjek' => $request->subjek,
            'pertanyaan' => $request->pertanyaan,
        ]);

        $data = new PesanResource($pesan);

        return response()->json([
            'message' => 'Data pesan dengan ID: ' . $id . ' berhasil diupdate',
            'data' => $data
        ], 200);
    }

    public function destroy($id)
    {
        $pesan = Pesan::find($id);
        $jawaban = Jawaban::where('pesan_id', $id)->get();

        if (!$pesan) {
            return response()->json([
                'message' => 'Data pesan ID: ' . $id . ' tidak ditemukan'
            ], 404);
        }

        if ($jawaban) {
            $jawaban->each->delete();
        }

        $pesan->delete();

        return response()->json([
            'message' => 'Data pesan ID: ' . $id . ' berhasil dihapus'
        ], 200);
    }
}
