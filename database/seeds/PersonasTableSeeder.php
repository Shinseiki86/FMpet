<?php
    
use Illuminate\Database\Seeder;

use App\Models\Persona;
use App\Models\Mascota;

use App\Models\PersonaTipo;

class PersonasTableSeeder extends Seeder {


    public function run() {
        //*********************************************************************
        $this->command->info('--- Seeder personas y mascotas prueba');

        $personaTipos = PersonaTipo::all();

        $personas = factory(Persona::class)->times(15)->make()
                        ->each(function ($persona) use ($personaTipos) {
                            $persona->personaTipo()->associate( $personaTipos->random() );
                            $persona->save();
                        });

        $mascotas = factory(Mascota::class)->times(10)->make()
                        ->each(function ($mascota) use ($personas) {
                            $mascota->persona()->associate( $personas->random() );
                            $mascota->save();
                        });
    }
}