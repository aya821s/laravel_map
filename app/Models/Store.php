<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    public function item_stores() {
        return $this->belongsToMany(Item::class)->withTimestamps();
    }
}
