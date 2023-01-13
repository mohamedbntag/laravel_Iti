<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ["product","admin_id", "price", "category", "image" ];

    public function user () {
        return $this->belongsTo('App\Model\User');
    }
}
