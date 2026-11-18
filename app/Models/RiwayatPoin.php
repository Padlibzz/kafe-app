<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

#[Fillable(['id_customer', 'id_aturan_loyalty', 'id_reward', 'tipe', 'poin', 'keterangan'])]
class RiwayatPoin extends Model
{
    protected $table = 'riwayat_poins';
    protected $primaryKey = 'id';
    protected $keyType = 'int';

    protected function casts(): array
    {
        return [
            'poin' => 'integer',
        ];
    }

    public function customer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }

    public function aturanLoyalty(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(AturanLoyalty::class, 'id_aturan_loyalty');
    }

    public function reward(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Reward::class, 'id_reward');
    }
}