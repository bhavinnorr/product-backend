<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $fillable = [
        'id',
        'name',
        'in_stock',
        // 'fileList',
        'category',
        'price'
    ];

    // Other model features, such as timestamps and table name

    // protected $casts = [
    //     'fileList' => 'array', // Assuming 'fileList' is an array field
    // ];

    // Optional: Set the table name explicitly if it's different from the default convention
    protected $table = 'product';

    public function images()
    {
        $this->hasMany(ProductImage::class);
    }
}