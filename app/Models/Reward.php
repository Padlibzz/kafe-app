<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

#[Fillable(['id_customer', 'id_aturan_loyalty', 'poin_digunakan', 'status'])]
class Reward extends Model
{
    protected $table = 'rewards';
    protected $primaryKey = 'id';
    protected $keyType = 'int';

    public function customer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }

    public function aturanLoyalty(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(AturanLoyalty::class, 'id_aturan_loyalty');
    }

    public function riwayatPoin(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(RiwayatPoin::class, 'id_reward');
    }
}