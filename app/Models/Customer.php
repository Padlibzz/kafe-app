<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

#[Fillable(['nama', 'email', 'password', 'saldo_poin'])]
#[Hidden(['password', 'remember_token'])]
class Customer extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'id_customer';
    protected $keyType = 'int';

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'saldo_poin' => 'integer',
        ];
    }

    public function pesanans(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Pesanan::class, 'id_customer');
    }

    public function riwayatPoin(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(RiwayatPoin::class, 'id_customer');
    }

    public function rewards(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Reward::class, 'id_customer');
    }

    public function notifikasis(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Notifikasi::class, 'id_customer');
    }
}
