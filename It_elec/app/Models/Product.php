<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryId');
    }
    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shopId');
    }
    protected $fillable = [
        'shopId',
        'name',
        'categoryId',
        'price',
        'quantity',
        'description',
        'image',
    ];
}
