<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cash extends Model
{
    /** @use HasFactory<\Database\Factories\CashFactory> */
    use HasFactory;
    protected $fillable = [
        'amount'
    ];
}
