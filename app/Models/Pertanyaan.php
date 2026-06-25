<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pertanyaan extends Model
{
    protected $table = 'pertanyaans';
    protected $primaryKey = 'id_pertanyaan';
    public $timestamps = false;

    protected $fillable = [
        'jenis_kuesioner',
        'konstruk',
        'nomor_item',
        'teks_pertanyaan',
        'is_reverse',
        'status',
    ];

    protected $casts = [
        'is_reverse' => 'boolean',
    ];

    public function jawabans(): HasMany
    {
        return $this->hasMany(Jawaban::class, 'id_pertanyaan', 'id_pertanyaan');
    }

    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    public function scopeJenis($query, string $jenis)
    {
        return $query->where('jenis_kuesioner', $jenis);
    }
}
