<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Season extends Model
{
    use HasFactory;

    protected $fillable = [
        'serie_id',
        'season_id',
        'episode_number',
        'name',
        'overview',
        'season_number',
    ];

    public function series(): BelongsTo
    {
        return $this->belongsTo(Serie::class);
    }

    public function episodes(): HasMany
    {
        return $this->hasMany(Episode::class);
    }
}
