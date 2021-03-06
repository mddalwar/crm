<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'productname',
        'stock',
        'unit',
        'purchaseprice',
        'sellprice',
        'category',
        'added_by',
        'updated_by',
        'description'
    ];
}
