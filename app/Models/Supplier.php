<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $guarded = ['id'];

    public function items() {
        return $this->hasMany(Item::class);
    }

    public function transaction() {
        return $this->hasMany(Transaction::class);
    }
}
