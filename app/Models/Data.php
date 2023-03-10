<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'email',
        'date'
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
