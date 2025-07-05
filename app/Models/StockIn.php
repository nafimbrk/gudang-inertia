<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockIn extends Model
{
    protected $guarded = ['id'];

    public function item() {
        return $this->belongsTo(Item::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
