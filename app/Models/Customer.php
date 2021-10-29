<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'due',
        'added_by',
        'status'
    ];

    public function created_by(){
        return $this->belongsTo( User::class, 'added_by' );
    }
}
