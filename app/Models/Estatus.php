<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estatus extends Model
{
    protected $table = 'estatus';

    protected $fillable = [
        'nombre',
        'estatus'
    ];
    public function proyectos(){
        return $this->hasMany(Proyecto::class, 'estatus_id');
    }
}
