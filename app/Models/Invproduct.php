<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invproduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'product_id',
        'quantity',
        'price',
        'profit',
        'total',
        'status',
    ];

    public function product(){
        return $this->belongsTo( Product::class );
    }
}
