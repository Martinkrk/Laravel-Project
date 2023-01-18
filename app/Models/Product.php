<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'discount',
        'bought',
        'image',
        'subcategory_id'
    ];

    public function product_filter()
    {
        return $this->hasMany('App\Models\ProductFilter');
    }

    public function subcategory()
    {
        return $this->belongsTo('App\Models\SubCategory', 'subcategory_id');
    }

    public function images()
    {
        return $this->hasMany('App\Models\Image');
    }

    public function rating()
    {
        return $this->hasMany('App\Models\Rating');
    }
}
