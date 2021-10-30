<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    public $fillable = [
    	'customer_id',
    	'amount',
    	'prevdue',
    	'note',
    	'collect_by',
    ];

    public function customer(){
        return $this->belongsTo( Customer::class, 'customer_id' );
    }

    public function created_by(){
        return $this->belongsTo( User::class, 'collect_by' );
    }

    // public function invoices(){
    //     return $this->hasMany( Invoice::class, 'customer_id' );
    // }
}
