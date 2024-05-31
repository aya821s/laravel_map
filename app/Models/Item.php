<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public function items_store() {
        return $this->belongsToMany(Store::class)->withTimestamps();
    }

    public function followed_users() {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
