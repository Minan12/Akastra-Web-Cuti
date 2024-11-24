<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JatahCuti extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function cuti()
    {
        return $this->belongsTo(Cuti::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke model Divisi (melalui User)
    public function divisi()
    {
        return $this->hasOneThrough(Divisi::class, User::class);
    }


    public function getDurationAttribute()
    {
        return $this->tgl_akhir_cuti->diffInDays($this->tgl_mulai_cuti) + 1;
    }
}
