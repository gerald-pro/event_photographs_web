<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SaleNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'nro_transaction',
        'user_id',
        'picture_id',
        'status',
    ];
}
