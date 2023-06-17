<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters){

        $lastSortDirection = session()->get('sort_direction', 'desc');


        $query->when($filters['search'] ?? false, function($query, $search){
            return $query->where('name', 'like', '%'.$search.'%');
        });
         $query->when($filters['status'] ?? false, function($query, $status){
            return $query->where('status', 'like', '%'.$status.'%');
        });
        $query->when($filters['sort'] ?? false, function($query, $sort)  use ($lastSortDirection){
            session()->put('sort_direction', $lastSortDirection === 'desc' ? 'asc' : 'desc');
            return $query->orderByRaw("$sort {$lastSortDirection}");
        });
    }
    public function product()
    {
        return $this->belongsTo (Product::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
