<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Showcase extends Model
{
    protected $fillable = ['title', 'description'];

//    public function reviews(): HasMany
//    {
//        return $this->hasMany(Review::class);
//    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
