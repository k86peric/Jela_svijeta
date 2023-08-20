<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['locale', 'title'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
