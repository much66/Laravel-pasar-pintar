<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory, Sluggable;
    protected $guarded = ['id'];
    protected $with = ['category', 'user'];

    public function scopeFilter($query, array $filters){

        $lastSortDirection = session()->get('sort_direction', 'desc');


        $query->when($filters['search'] ?? false, function($query, $search){
            return $query->where('name', 'like', '%'.$search.'%');
        });


        $query->when($filters['category'] ?? false, function($query, $category){
            return $query->whereHas('category', function($query) use ($category){
                $query->where('slug', $category);
            });
        });

        $query->when($filters['user'] ?? false, function($query, $user){
            return $query->whereHas('user', function($query) use ($user){
                $query->where('username', $user);
            });
        });

        $query->when($filters['sort'] ?? false, function($query, $sort)  use ($lastSortDirection){
            session()->put('sort_direction', $lastSortDirection === 'desc' ? 'asc' : 'desc');
            return $query->orderByRaw("$sort {$lastSortDirection}");
        });


    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function keranjang(){
        return $this->hasMany(Keranjang::class);
    }
    public function ulasan(){
        return $this->hasMany(Ulasan::class);
    }
    public function recipe(): BelongsToMany
    {
        return $this->belongsToMany(Recipe::class)->withTimestamps();
    }
    public function sluggable(): array
    {
        return[
            'slug' => [
                'source' => 'name'
                ]
            ];
    }
}
