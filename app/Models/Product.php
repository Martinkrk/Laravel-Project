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
        'subcategory_id'
    ];

    public function product_filter()
    {
        return $this->hasMany('App\Models\ProductFilter');
    }

    public function subcategory()
    {
        return $this->belongsTo('App\Models\SubCategory');
    }
}
