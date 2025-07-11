<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = ['id'];

    public $table = 'stock_transactions';

    public function item() {
        return $this->belongsTo(Item::class);
    }
    public function supplier() {
        return $this->belongsTo(Supplier::class);
    }
    public function warehouse() {
        return $this->belongsTo(Warehouse::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
