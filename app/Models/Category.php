<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'added_by',
        'updated_by',
        'status',
    ];

    public function products(){
        return $this->hasMany( Product::class );
    }

    public function created_by(){
        return $this->belongsTo( User::class, 'added_by' );
    }
}
