<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Genre extends Model
{
    use HasFactory;

    public function translations(): MorphMany
    {
        return $this->morphMany(Translations::class,'translatable');
    }

    protected $fillable = [
        'title',
        'tmdb_id',
        'translations',
    ];
}
