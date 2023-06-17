<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Recipe extends Model
{
    use HasFactory, Sluggable;
    protected $guarded = ['id'];
    protected $with = ['type', 'user'];
    public function scopeFilter($query, array $filters){
        // if(isset($filters['search']) ? $filters['search'] : false ){
        //     return $query->where('title', 'like', '%'.$filters['search'].'%')->orwhere('body', 'like', '%'.$filters['search'].'%');
        // }

        $query->when($filters['search'] ?? false, function($query, $search){
            return $query->where('name', 'like', '%'.$search.'%');
        });

        $query->when($filters['type'] ?? false, function($query, $type){
            return $query->whereHas('type', function($query) use ($type){
                $query->where('slug', $type);
            });
        });

        $query->when($filters['user'] ?? false, function($query, $user){
            return $query->whereHas('user', function($query) use ($user){
                $query->where('username', $user);
            });
        });
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function type(){
        return $this->belongsTo(Type::class);
    }
    public function product(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
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
