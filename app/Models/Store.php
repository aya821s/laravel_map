<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Store extends Model
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, Sortable;
    protected $dates = ['deleted_at'];

    // public function items() {
    //     return $this->belongsToMany(Item::class)->withTimestamps();
    // }

    public function posts() {
        return $this->hasMany(Post::class);
    }
}
