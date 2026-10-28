<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];

    public function showcases()
    {
        return $this->belongsToMany(Showcase::class);
    }

}
