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
        'slug'
    ];

    public function getPrefix()
    {
        return Prefix::where('type', 'serie')->value('value') ?? '';
    }
    public function getTitleWithPrefixAttribute(): string
    {
        return "{$this->title}" . " " . $this->getPrefix();
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($serie) {
            $serie->slug = Str::slug($serie->title_with_prefix);
        });

        static::updating(function ($serie) {
            if (!$serie->isDirty('slug')) {
                $serie->slug = Str::slug($serie->title_with_prefix);
            }
        });
    }
}
