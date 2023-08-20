<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    use HasFactory;

    public function entity()
    {
        return $this->morphTo();
    }

    public function language()
    {
        return $this->belongsTo(Lang::class);
    }
}
