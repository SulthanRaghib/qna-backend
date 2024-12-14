<?php

namespace App\Events;

use App\Models\Pesan;
use App\Models\User;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class PesanEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $subjek;
    private $pertanyaan;
    private $user_id;
    private $status_id;
    private $tanggal_dibuat;


    /**
     * Create a new event instance.
     */
    public function __construct($subjek, $pertanyaan, $user_id, $status_id, $tanggal_dibuat)
    {
        $newPesan = new Pesan();
        $newPesan->subjek = $subjek;
        $newPesan->pertanyaan = $pertanyaan;
        $newPesan->user_id = Auth::user()->id ?? 2;
        $newPesan->status_id = $status_id;
        $newPesan->tanggal_dibuat = now();
        $newPesan->save();

        $this->subjek = $subjek;
        $this->pertanyaan = $pertanyaan;
        $this->user_id = $user_id;
        $this->status_id = $status_id;
        $this->tanggal_dibuat = $tanggal_dibuat;
    }

    /**
     * Get the data to broadcast.
     *
     * @return array<string, mixed>
     */
    public function broadcastWith(): array
    {
        return [
            'subjek' => $this->subjek,
            'pertanyaan' => $this->pertanyaan,
            'user_id' => $this->user_id,
            'status_id' => $this->status_id,
            'tanggal_dibuat' => $this->tanggal_dibuat
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('send-message'),
        ];
    }
}
