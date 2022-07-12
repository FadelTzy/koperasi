<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mataKuliah extends Model
{
    protected $guarded = [];
    use HasFactory;
    public function namadosen()
    {
        return $this->hasOne(User::class, 'id', 'dosen');
    }
    public function namamitra()
    {
        return $this->hasOne(User::class, 'id', 'mitra');
    }
}
