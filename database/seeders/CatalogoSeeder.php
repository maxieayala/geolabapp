<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Opciones\Catalogo;
use Illuminate\Support\Facades\DB;

class CatalogoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //-------------------------------------------------------------
        // Crear Tipo cliente
        //1
        $catalogo = Catalogo::create([
            // id_padre =>
            'nombre'   => 'Tipo_Cliente',
            'descripcion'   => 'Tipo Cliente ',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        //2
        $catalogo = Catalogo::create([
            'id_padre' =>   1,
            'nombre'   => 'Juridica',
            'descripcion'   => 'Persona Juridica',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        //3
        $catalogo = Catalogo::create([
            'id_padre' =>   1,
            'nombre'   => 'Natural',
            'descripcion'   => 'Persona Natural',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        //-------------------------------------------------------------
        // Crear Tipo suelo -Clasificacion_AASHTO
        //4
        $catalogo = Catalogo::create([
            // id_padre =>
            'nombre'   => 'Clasificacion_AASHTO',
            'descripcion'   => 'Clasificacion basado estandar AASHTO ',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        //5
        $catalogo = Catalogo::create([
            'id_padre' =>   4,
            'nombre'   => 'A-1',
            'descripcion'   => 'Fragmentos pétreos de gravas y arenas',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        //6
        $catalogo = Catalogo::create([
            'id_padre' =>   4,
            'nombre'   => 'A-2',
            'descripcion'   => 'Gravas y arenas, limosas y arcillosa',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        //7
        $catalogo = Catalogo::create([
            'id_padre' =>   4,
            'nombre'   => 'A-3',
            'descripcion'   => 'Arena fina',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        //8
        $catalogo = Catalogo::create([
            'id_padre' =>   4,
            'nombre'   => 'A-4',
            'descripcion'   => 'Suelos limosos',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        //9
        $catalogo = Catalogo::create([
            'id_padre' =>   4,
            'nombre'   => 'A-5',
            'descripcion'   => 'Suelos limosos',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        //10
        $catalogo = Catalogo::create([
            'id_padre' =>   4,
            'nombre'   => 'A-6',
            'descripcion'   => 'Suelos arcillosos',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        //11
        $catalogo = Catalogo::create([
            'id_padre' =>   4,
            'nombre'   => 'A-7',
            'descripcion'   => 'Suelos arcillosos',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        //12
        $catalogo = Catalogo::create([
            'id_padre' =>   4,
            'nombre'   => 'A-1-a',
            'descripcion'   => 'Fragmentos pétreos de gravas y arenas',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        //13
        $catalogo = Catalogo::create([
            'id_padre' =>   4,
            'nombre'   => 'A-1-b',
            'descripcion'   => 'Fragmentos pétreos de gravas y arenas',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
                //14
        $catalogo = Catalogo::create([
            'id_padre' =>   4,
            'nombre'   => 'A-2-4',
            'descripcion'   => 'Gravas y arenas, limosas y arcillosa',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
                //15
        $catalogo = Catalogo::create([
            'id_padre' =>   4,
            'nombre'   => 'A-2-5',
            'descripcion'   => 'Gravas y arenas, limosas y arcillosa',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        //16
        $catalogo = Catalogo::create([
            'id_padre' =>   4,
            'nombre'   => 'A-2-6',
            'descripcion'   => 'Gravas y arenas, limosas y arcillosa',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        //17
        $catalogo = Catalogo::create([
            'id_padre' =>   4,
            'nombre'   => 'A-2-7',
            'descripcion'   => 'Gravas y arenas, limosas y arcillosa',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        //18
        $catalogo = Catalogo::create([
            'id_padre' =>   4,
            'nombre'   => 'A-7-5',
            'descripcion'   => 'Suelos arcillosos',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        //19
        $catalogo = Catalogo::create([
            'id_padre' =>   4,
            'nombre'   => 'A-7-6',
            'descripcion'   => 'Suelos arcillosos',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        //-------------------------------------------------------------
        //  Crear Tipo suelo -Clasificacion_SUCS
        $catalogo = Catalogo::create([
            // id_padre =>
            'nombre'   => 'Clasificacion_SUCS',
            'descripcion'   => 'Clasificación de Suelo según el Sistema SUCS ',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
