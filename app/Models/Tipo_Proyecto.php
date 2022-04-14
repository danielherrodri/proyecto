<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_Proyecto extends Model
{
    protected $table = 'tipo_proyecto';

    protected $fillable = [
        'nombre',
        'estatus',
    ];
}
