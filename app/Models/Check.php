<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
    use HasFactory;
    public function user () {
        return $this->belongsTo('App\Model\User');
    }

    public function orders () {
        return $this->hasMany('App\Models\Order');
    }
    
}
