<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    protected $fillable = [
        'item_description',
        'quantity',
        'unit',
        'cost',
        'category',
    ];

    public function getTotalAttribute()
    {
        return $this->quantity * $this->cost;
    }
}