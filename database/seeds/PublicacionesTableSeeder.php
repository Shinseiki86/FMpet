<?php
    
use Illuminate\Database\Seeder;

use App\Models\Publicacion;
use App\Models\PublicacionTipo;
use App\Models\PublicacionEstado;
use App\Models\Persona;
use App\Models\Barrio;


class PublicacionesTableSeeder extends Seeder {


    public function run() {
        //*********************************************************************
        $this->command->info('--- Seeder Publicaciones');

        $personas = Persona::with('mascotas')->has('mascotas')->get();
        $barrios = Barrio::all();
        $pubTipos = PublicacionTipo::all();
        $pubEstados = PublicacionEstado::all();

        $publicaciones = factory(Publicacion::class)->times(50)->make()
                        ->each(function ($publ) use ($personas,$barrios,$pubTipos,$pubEstados) {
                            $pers = $personas->random();
                            $publ->persona()->associate( $pers );
                            $publ->mascota()->associate( $pers->mascotas->random() );
                            $publ->barrio()->associate( $barrios->random() );
                            $publ->publicacionEstado()->associate( $pubEstados->random() );
                            $publ->publicacionTipo()->associate( $pubTipos->random() );
                            $publ->save();
                        });

    }
}