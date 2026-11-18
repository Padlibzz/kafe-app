<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

#[Fillable(['id_pesanan', 'status_lama', 'status_baru', 'created_by'])]
class LogStatusPesanan extends Model
{
    protected $table = 'log_status_pesanans';
    protected $primaryKey = 'id';
    protected $keyType = 'int';

    public function pesanan(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan');
    }
}