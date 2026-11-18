<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

#[Fillable(['start_date', 'end_date', 'total_pendapatan', 'total_biaya'])]
class LaporanKeuangan extends Model
{
    protected $table = 'laporan_keuangans';
    protected $primaryKey = 'id';
    protected $keyType = 'int';

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'total_pendapatan' => 'decimal:2',
            'total_biaya' => 'decimal:2',
        ];
    }
}