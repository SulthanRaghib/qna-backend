<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    protected $table = 'jawabans';
    protected $fillable = ['jawaban', 'pesan_id', 'user_id'];

    public function pesan()
    {
        return $this->belongsTo(Pesan::class, 'pesan_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
