<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Meal extends Model
{
    use HasFactory;

    protected $fillable = [
        
    ];

    public function translations()
    {
        return $this->hasMany(MealTranslation::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class, 'meal_ingredients');
    }

    public function translatedTitle($lang)
    {
        return $this->translations->where('locale', $lang)->first()->title;
    }

    public function translatedDescription($lang)
    {
        return $this->translations->where('locale', $lang)->first()->description;
    }
}
