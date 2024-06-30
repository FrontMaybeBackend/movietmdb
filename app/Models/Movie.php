<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'overview',
        'tmdb_id',
        'language',
    ];

    public function translations(): HasMany
    {
        return $this->hasMany(Translations::class,'id','movie_id');
    }






}
