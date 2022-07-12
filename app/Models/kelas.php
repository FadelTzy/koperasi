<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kelas extends Model
{
    protected $guarded = [];
    use HasFactory;
    public function namaketi()
    {
        return $this->hasOne(User::class, 'no_identitas', 'id_keti');
    }
}
