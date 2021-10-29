<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'stock',
        'prevstock',
        'price',
        'note',
        'added_by',
    ];

    public function product(){
        return $this->belongsTo( Product::class );
    }

    public function created_by(){
        return $this->belongsTo( User::class, 'added_by');
    }
}
