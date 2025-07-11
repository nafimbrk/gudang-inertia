<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded = ['id'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function supplier() {
        return $this->belongsTo(Supplier::class);
    }

    public function warehouse() {
        return $this->belongsTo(Warehouse::class);
    }

    public function transaction() {
        return $this->hasMany(Transaction::class);
    }

    public function unit() {
        return $this->belongsTo(Unit::class);
    }
}
