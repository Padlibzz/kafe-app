<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

#[Fillable(['id_pesanan', 'id_menu', 'jumlah', 'subtotal'])]
class DetailPesanan extends Model
{
    protected $table = 'detail_pesanans';
    protected $primaryKey = 'id';
    protected $keyType = 'int';

    protected function casts(): array
    {
        return [
            'subtotal' => 'decimal:2',
        ];
    }

    public function pesanan(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan');
    }

    public function menu(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Menu::class, 'id_menu');
    }
}
