<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Polres extends Model
{
    use HasFactory;

    protected $table = 'polres';
    protected $primaryKey = 'id_polres';

    protected $fillable = [
        'nama_polres',
        'wilayah',
    ];

    public function respondens(): HasMany
    {
        return $this->hasMany(Responden::class, 'id_polres', 'id_polres');
    }
}
