<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
        'bid_price',
    ];

    protected $table = 'bids';
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
