<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
        'price',
    ];

    protected $table = 'purchases';
      // relationship with accidents table
      public function product()
      {
          return $this->belongsTo(Product::class);
      }
  
       // relationship with documents table
      public function user()
      {
          return $this->belongsTo(User::class);
      }
}
