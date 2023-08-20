<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngredientTranslation extends Model
{
    use HasFactory;
    protected $fillable = ['locale', 'title'];

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
    public $timestamps = false;
}
