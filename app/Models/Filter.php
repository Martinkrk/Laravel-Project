<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    use HasFactory;
    protected $table = 'filters';
    public $timestamps = true;

    protected $fillable = [
        'name'
    ];

    public function filter_subcategory()
    {
        return $this->hasMany('App\Models\FilterSubcategory');
    }

    public function product_filter()
    {
        return $this->hasMany('App\Models\ProductFilter');
    }
}
