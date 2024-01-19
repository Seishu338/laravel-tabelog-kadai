<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;

    public function restaurants(){
        return $this->belongsToMany(Restaurant::class, 'closing_days');
    }
}
