<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFilter extends Model
{
    use HasFactory;
    protected $table = 'product_filter';
    public $timestamps = true;

    protected $fillable = [
        'product_id',
        'filter_id',
        'value'
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }

    public function filter()
    {
        return $this->belongsTo('App\Models\Filter', 'filter_id');
    }
}
