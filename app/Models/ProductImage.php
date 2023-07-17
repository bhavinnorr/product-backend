<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'product_id',
        'file_name'
    ];

    // Other model features, such as timestamps and table name

    protected $casts = [
        'file_name' => 'array', // Assuming 'fileList' is an array field
    ];
    protected $table = "product_images";
}
