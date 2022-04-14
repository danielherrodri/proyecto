<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $table = 'proyectos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'slug',
        'proyecto_id',
        'estatus_id',
        'user_id',
    ];

    public function estatus()
    {
        return $this->belongsTo(Estatus::class, 'estatus_id');
    }

    public function tipoProyecto()
    {
        return $this->belongsTo(Tipo_Proyecto::class, 'proyecto_id');
    }

    public function usuario()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
