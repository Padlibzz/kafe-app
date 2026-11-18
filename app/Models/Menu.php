<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

#[Fillable(['nama_menu', 'deskripsi', 'harga', 'foto', 'ketersediaan'])]
class Menu extends Model
{
    protected $table = 'menus';
    protected $primaryKey = 'id_menu';
    protected $keyType = 'int';

    protected function casts(): array
    {
        return [
            'harga' => 'decimal:2',
            'ketersediaan' => 'boolean',
        ];
    }

    public function detailPesanan(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(DetailPesanan::class, 'id_menu');
    }
}
