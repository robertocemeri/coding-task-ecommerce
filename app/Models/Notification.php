<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'text',
        'is_read',
    ];

    protected $table = 'notifications';
  
       // relationship with documents table
      public function user()
      {
          return $this->belongsTo(User::class);
      }
}
