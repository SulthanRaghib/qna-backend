<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PesanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'subjek' => $this->subjek,
            'pertanyaan' => $this->pertanyaan,
            'user' => $this->user->username,
            'tanggal_dibuat' => now()->parse($this->tanggal_dibuat)->format('d F Y H:i:s'),
            'status' => $this->status->name,
            'created_at' => $this->created_at,
        ];
    }
}
