<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public function inventory()
    {
        return $this->hasOne(Inventory::class,'inventory_id','id');
    }
}
