<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ktAngsuran extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function datapinjaman()
    {
        return $this->hasOne(ktPinjam::class, 'id', 'id_pinjaman');
    }
}
