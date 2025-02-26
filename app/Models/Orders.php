<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'total',
        'status',
        'customers_id',
        'product_id',
    ];
}
