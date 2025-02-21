<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;


class Serie extends Model
{
    use HasFactory;

    public function translations(): HasMany
    {
        return $this->hasMany(TranslationSerie::class, 'id', 'serie_id');
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
        'prefix',
        'slug'
    ];

    public function getTitleWithPrefixAttribute(): string
    {
        return "{$this->title}" . " " . "{$this->prefix}";
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($movie) {
            $movie->slug = Str::slug($movie->title . ' ' . $movie->prefix);
        });

        static::updating(function ($movie) {
            if (!$movie->isDirty('slug')) {
                $movie->slug = Str::slug($movie->title . ' ' . $movie->prefix);
            }
        });
    }
}
