<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRecipe extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function product(){
        return $this->belongsToMany(Product::class, 'product_recipes');
    }
    public function recipe(){
        return $this->belongsToMany(Recipe::class, 'recipe_recipes');
    }

}
