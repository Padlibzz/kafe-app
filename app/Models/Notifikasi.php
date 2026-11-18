<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

#[Fillable(['id_customer', 'id_pesanan', 'judul', 'isi', 'status_baca'])]
class Notifikasi extends Model
{
    protected $table = 'notifikasis';
    protected $primaryKey = 'id';
    protected $keyType = 'int';

    protected function casts(): array
    {
        return [
            'status_baca' => 'boolean',
        ];
    }

    public function customer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }

    public function pesanan(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan');
    }
}