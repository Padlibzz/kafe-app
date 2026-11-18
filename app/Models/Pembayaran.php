<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

#[Fillable(['id_pesanan', 'metode', 'nominal', 'status'])]
class Pembayaran extends Model
{
    protected $table = 'pembayarans';
    protected $primaryKey = 'id';
    protected $keyType = 'int';

    protected function casts(): array
    {
        return [
            'nominal' => 'decimal:2',
        ];
    }

    public function pesanan(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan');
    }
}