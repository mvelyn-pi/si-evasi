<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Jawaban extends Model
{
    protected $table = 'jawabans';
    protected $primaryKey = 'id_jawaban';
    public $timestamps = false;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = null;

    protected $fillable = [
        'id_responden',
        'id_pertanyaan',
        'skor',
    ];

    public function responden(): BelongsTo
    {
        return $this->belongsTo(Responden::class, 'id_responden', 'id_responden');
    }

    public function pertanyaan(): BelongsTo
    {
        return $this->belongsTo(Pertanyaan::class, 'id_pertanyaan', 'id_pertanyaan');
    }
}
