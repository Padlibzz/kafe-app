<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

#[Fillable(['nama', 'username', 'password', 'hak_akses'])]
#[Hidden(['password'])]
class Karyawan extends Model
{
    protected $table = 'karyawans';
    protected $primaryKey = 'id_karyawan';
    protected $keyType = 'int';

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function absensis(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Absensi::class, 'id_karyawan');
    }
}
