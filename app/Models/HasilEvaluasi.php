<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HasilEvaluasi extends Model
{
    protected $table = 'hasil_evaluasis';
    protected $primaryKey = 'id_hasil';

    protected $fillable = [
        'id_responden',
        'skor_pemahaman',
        'skor_pu',
        'skor_peou',
        'skor_atu',
        'skor_bi',
        'skor_sus',
        'kategori_pemahaman',
        'kategori_tam',
        'kategori_sus',
    ];

    public function responden(): BelongsTo
    {
        return $this->belongsTo(Responden::class, 'id_responden', 'id_responden');
    }

    /**
     * Accessor: skor TAM keseluruhan = rata-rata dari 4 konstruk.
     * Pendekatan ini sesuai literatur TAM (Davis et al., 1989).
     */
    public function getSkorTamAttribute(): ?float
    {
        if ($this->skor_pu && $this->skor_peou && $this->skor_atu && $this->skor_bi) {
            return round(($this->skor_pu + $this->skor_peou + $this->skor_atu + $this->skor_bi) / 4, 2);
        }
        return null;
    }
}
