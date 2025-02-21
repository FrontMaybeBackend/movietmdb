<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;


class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'overview',
        'tmdb_id',
        'language',
        'slug',
    ];

    public function translations(): HasMany
    {
        return $this->hasMany(Translations::class, 'id', 'movie_id');
    }

    public function getTitleWithPrefixAttribute(): string
    {
        return "{$this->title}" . " " . $this->getPrefix();
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getPrefix()
    {
        return Prefix::where('type','movie')->value('value') ?? '';
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($movie) {
            $movie->slug = Str::slug($movie->title_with_prefix);
        });

        static::updating(function ($movie) {
            if (!$movie->isDirty('slug')) {
                $movie->slug = Str::slug($movie->title_with_prefix);
            }
        });
    }


}
