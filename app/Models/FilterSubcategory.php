<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilterSubcategory extends Model
{
    use HasFactory;
    protected $table = 'filter_subcategory';
    public $timestamps = true;

    protected $fillable = [
        'subcategory_id',
        'filter_id'
    ];

    public function subcategory()
    {
        return $this->belongsTo('App\Models\SubCategory', 'subcategory_id');
    }

    public function filter()
    {
        return $this->belongsTo('App\Models\Filter', 'filter_id');
    }
}
