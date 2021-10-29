<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invest extends Model
{
    use HasFactory;

    protected $fillable = [
        'investor_name',
        'amount',
        'note',
        'added_by',
        'updated_by',
    ];

    public function created_by(){
        return $this->belongsTo(User::class, 'added_by');
    }
}
