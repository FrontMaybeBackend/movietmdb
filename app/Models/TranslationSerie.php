<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TranslationSerie extends Model
{
    use HasFactory;

    protected $fillable = [
        'serie_id',
        'trans_pl_title',
        'trans_pl_overview',
        'trans_de_title',
        'trans_de_overview',

    ];

    public function serie(): BelongsTo
    {
        return $this->belongsTo(serie::class,'id','serie_id');
    }
}
