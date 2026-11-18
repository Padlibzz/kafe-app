<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

#[Fillable(['id_customer', 'id_meja', 'status', 'total_harga', 'catatan'])]
class Pesanan extends Model
{
    protected $table = 'pesanans';
    protected $primaryKey = 'id';
    protected $keyType = 'int';

    protected function casts(): array
    {
        return [
            'total_harga' => 'decimal:2',
        ];
    }

    public function customer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }

    public function meja(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Meja::class, 'id_meja');
    }

    public function detailPesanan(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(DetailPesanan::class, 'id_pesanan');
    }

    public function pembayarans(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Pembayaran::class, 'id_pesanan');
    }

    public function logStatusPesanan(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(LogStatusPesanan::class, 'id_pesanan');
    }

    public function notifikasis(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Notifikasi::class, 'id_pesanan');
    }
}
