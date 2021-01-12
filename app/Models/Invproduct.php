<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invproduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice',
        'product',
        'quantity',
        'price',
        'profit',
        'total',
        'status',
    ];
}
