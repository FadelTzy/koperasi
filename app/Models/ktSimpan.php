<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ktSimpan extends Model
{
    public function datauser()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }
    protected $guarded = [];
    use HasFactory;
}
