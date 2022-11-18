<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'type',
        'has_paid',
        'comment',
    ];
}
