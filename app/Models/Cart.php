<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public function user () {
        return $this->belongsTo('App\Model\User');
        //protected $fillable = ["user_id","name", "email", "Room_No", "Ext", "product", "image", "quantity", "price", 'created_at', 'updated_at' ];

    }
    
}
