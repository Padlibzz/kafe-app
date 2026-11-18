<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

#[Fillable(['nama', 'deskripsi', 'poin_per_transaksi', 'minimal_poin'])]
class AturanLoyalty extends Model
{
    protected $table = 'aturan_loyalties';
    protected $primaryKey = 'id';
    protected $keyType = 'int';

    protected function casts(): array
    {
        return [
            'poin_per_transaksi' => 'integer',
            'minimal_poin' => 'integer',
        ];
    }

    public function rewards(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Reward::class, 'id_aturan_loyalty');
    }

    public function riwayatPoin(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(RiwayatPoin::class, 'id_aturan_loyalty');
    }
}