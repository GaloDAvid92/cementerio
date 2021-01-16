<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boveda extends Model
{
    protected $table = 'bovedas';

    protected $fillable = [
        'nombre',
        'estado',
        'filas',
        'columnas'
    ];

    use HasFactory;
}
