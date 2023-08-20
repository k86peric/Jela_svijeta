<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [

    ];

    public function meals()
    {
        return $this->hasMany(Meal::class);
    }

    public function translations()
    {
        return $this->hasMany(CategoryTranslation::class);
    }

    public function translatedTitle($lang)
    {
        return $this->translations->where('locale', $lang)->first()->title;
    }
}
