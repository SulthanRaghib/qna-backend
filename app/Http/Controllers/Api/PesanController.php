<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PesanResource;
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
            'message' => 'Berhasil menampilkan data',
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
            'message' => 'Data berhasil ditambahkan',
            'data' => $data
        ], 201);
    }

    public function show($id)
    {
        $pesan = Pesan::with(['status', 'user'])->find($id);

        if (!$pesan) {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $data = new PesanResource($pesan);

        return response()->json([
            'message' => 'Berhasil menampilkan data ' . $id,
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
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $pesan->update([
            'subjek' => $request->subjek,
            'pertanyaan' => $request->pertanyaan,
        ]);

        $data = new PesanResource($pesan);

        return response()->json([
            'message' => 'Data berhasil diubah ' . $id,
            'data' => $data
        ], 200);
    }

    public function destroy($id)
    {
        $pesan = Pesan::find($id);

        if (!$pesan) {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $pesan->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus ' . $id
        ], 200);
    }
}
