<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = ['name'];

    public function pesans()
    {
        return $this->hasMany(Pesan::class, 'status_id', 'id');
    }
}
