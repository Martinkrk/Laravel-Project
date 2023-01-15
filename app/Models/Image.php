<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $table = 'product_images';
    public $timestamps = true;

    protected $fillable = [
        'image',
        'product_id'
        ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
