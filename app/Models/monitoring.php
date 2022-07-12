<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class monitoring extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function namadosen()
    {
        return $this->hasOne(User::class, 'id', 'id_dosen');
    }
    public function namaketi()
    {
        return $this->hasOne(User::class, 'no_identitas', 'id_keti');
    }
    public function namaruang()
    {
        return $this->hasOne(ruangan::class, 'id', 'ruang');
    }
    public function namakelas()
    {
        return $this->hasOne(kelas::class, 'id', 'kelas');
    }
    public function namamatkul()
    {
        return $this->hasOne(mataKuliah::class, 'id', 'matkul');
    }
}
