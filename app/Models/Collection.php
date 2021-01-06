<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    public $fillable = [
    	'customer',
    	'amount',
    	'prevdue',
    	'note',
    	'collect_by',
    ];
}
