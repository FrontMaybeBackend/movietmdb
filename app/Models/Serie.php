<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Serie extends Model
{
    use HasFactory;

    public function translations(): HasMany
    {
        return $this->hasMany(TranslationSerie::class,'id','serie_id');
    }

    public function seasons(): HasMany
    {
        return $this->hasMany(Season::class);
    }

    protected $fillable = [
        'title',
        'overview',
        'tmdb_id',
        'translations',
    ];
}
