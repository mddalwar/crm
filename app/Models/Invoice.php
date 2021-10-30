<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'discount',
        'paid',
        'due',
        'subtotal',
        'total',
        'note',
        'added_by'
    ];

    public function customer(){
        return $this->belongsTo( Customer::class );
    }

    public function products(){
        return $this->hasMany( Invproduct::class );
    }

    public function created_by(){
        return $this->belongsTo( User::class, 'added_by' );
    }
}
