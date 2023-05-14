<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'category_id',
    ];

    protected $table = 'product_categories';

    // relationship with accidents table
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

     // relationship with documents table
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
