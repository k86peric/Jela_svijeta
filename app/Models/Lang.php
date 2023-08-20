<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lang extends Model
{
    use HasFactory;

    protected $table = 'lang';
    protected $fillable = [
        'code',
        'name',
    ];

    public function translations()
    {
        return $this->hasMany(Translation::class);
    }

    public $timestamps = false;
}
