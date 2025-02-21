<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Prefix extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'value'
    ];

    protected static function boot()
    {
        parent::boot();

        static::updated(function ($prefix) {
            $modelClass = $prefix->type === 'movie' ? Movie::class : Serie::class;
            $items = $modelClass::all();
            foreach ($items as $item) {
                $item->slug = Str::slug($item->title . ' ' . $prefix->value);
                $item->save();
            }
        });
    }
}
