<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Meja extends Model
{
    protected $table = 'mejas';

    protected $primaryKey = 'id_meja';

    protected $keyType = 'int';

    public function pesanans(): HasMany
    {
        return $this->hasMany(Pesanan::class, 'id_meja');
    }
}
