<?php

namespace Database\Seeders;

use App\Models\Estatus;
use App\Models\Tipo_Proyecto;
use Illuminate\Database\Seeder;

class TipoProyectoCatalogoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estatus::create([
            'nombre' => 'Personal'
        ]);
        Estatus::create([
            'nombre' => 'Finalizado'
        ]);
        Estatus::create([
            'nombre' => 'Cancelado'
        ]);

        Tipo_Proyecto::create([
            'nombre' => 'Personal',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Tipo_Proyecto::create([
            'nombre' => 'Negocios',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Tipo_Proyecto::create([
            'nombre' => 'Caridad',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Tipo_Proyecto::create([
            'nombre' => 'Desarrollo',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Tipo_Proyecto::create([
            'nombre' => 'Viajes',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
