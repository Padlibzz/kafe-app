<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

#[Fillable(['nama', 'username', 'password'])]
#[Hidden(['password'])]
class Admin extends Model
{
    protected $table = 'admins';
    protected $primaryKey = 'id_admin';
    protected $keyType = 'int';

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function karyawans(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Karyawan::class, 'id_karyawan');
    }
}
