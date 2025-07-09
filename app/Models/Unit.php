<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $guarded = ['id'];

    public function items() {
        return $this->hasMany(Item::class);
    }
}
