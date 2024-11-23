<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JawabanResource extends JsonResource
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
            'subjek' => $this->pesan->subjek,
            'pertanyaan' => $this->pesan->pertanyaan,
            'jawaban' => $this->jawaban,
            'status' => $this->status->name,
        ];
    }
}
