<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        

    ];

    public function meals()
    {
        return $this->belongsToMany(Meal::class);
    }

    public function translations()
    {
        return $this->hasMany(TagTranslation::class);
    }

    public function translatedTitle($lang)
    {
        return $this->translations->where('locale', $lang)->first()->title;
    }
}
