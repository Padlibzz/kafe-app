<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

#[Fillable(['nomor_meja', 'kode_qr'])]
class Meja extends Model
{
    protected $table = 'mejas';
    protected $primaryKey = 'id_meja';
    protected $keyType = 'int';

    public function pesanans(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Pesanan::class, 'id_meja');
    }
}
