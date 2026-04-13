<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'image',
        'description',
    ];

    protected $casts = [
        'price' => 'integer',
    ];

    public function seasons()
    {
        return $this->belongsToMany(Season::class, 'product_season')
            ->withTimestamps();
    }

    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%");
            });
        }
        return $query;
    }

    public function scopeSortByPrice($query, $sort)
    {
        if ($sort === 'price_desc') {
            $query->orderBy('price', 'desc');
        } elseif ($sort === 'price_asc') {
            $query->orderBy('price', 'asc');
        }

        return $query;
    }
}
