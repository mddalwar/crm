<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invest extends Model
{
    use HasFactory;

    protected $fillable = [
        'investby',
        'amount',
        'note',
        'added_by',
        'updated_by',
    ];
}
