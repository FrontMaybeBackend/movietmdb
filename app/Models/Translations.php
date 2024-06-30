<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Translations extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'overview',
        'movie_id',
        'trans_pl_title',
        'trans_pl_overview',
        'trans_de_title',
        'trans_de_overview',

    ];

    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class,'id','movie_id');
    }

}
