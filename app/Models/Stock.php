<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'product',
        'stock',
        'prevstock',
        'price',
        'avarageprice',
        'note',
        'added_by',
    ];
}
