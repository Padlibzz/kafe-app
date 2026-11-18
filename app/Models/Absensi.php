<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

#[Fillable(['id_karyawan', 'status', 'jam_masuk', 'jam_keluar', 'tanggal'])]
class Absensi extends Model
{
    protected $table = 'absensis';
    protected $primaryKey = 'id';
    protected $keyType = 'int';

    protected function casts(): array
    {
        return [
            'jam_masuk' => 'datetime',
            'jam_keluar' => 'datetime',
            'tanggal' => 'date',
        ];
    }

    public function karyawan(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }
}