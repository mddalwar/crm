<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'productid',
        'customerid',
        'sellquantity',
        'totalamount',
        'discount',
        'paid',
        'due',
        'note'
    ];
}
