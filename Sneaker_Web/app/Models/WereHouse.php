<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WereHouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'size',
        'import_price'
    ];

    
}
