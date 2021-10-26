<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'quantity',
        'unit',
        'purchaseprice',
        'category_id',
        'added_by',
        'updated_by',
        'note',
        'status'
    ];

    public function category(){
        return $this->belongsTo( Category::class );
    }
}
