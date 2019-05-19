<?php
    
use Illuminate\Database\Seeder;

use App\Models\Persona;
use App\Models\Mascota;
use App\Models\PersonaTipo;

class PersonasTableSeeder extends Seeder {


    public function run() {
        //*********************************************************************
        $this->command->info('--- Seeder personas y mascotas prueba');

        $personaTipos = [
            ['PETI_NOMBRE' => 'NATURAL'],
            ['PETI_NOMBRE' => 'JURIDICA'],
        ];
        foreach ($personaTipos as $tipo) {
            PersonaTipo::create($tipo);
        }
        
        $personaTipos = PersonaTipo::all();

        $personas = factory(Persona::class)->times(100)->make()
                        ->each(function ($persona) use ($personaTipos) {
                            $persona->personaTipo()->associate( $personaTipos->random() );
                            $persona->save();
                        });

        $mascotas = factory(Mascota::class)->times(100)->make()
                        ->each(function ($mascota) use ($personas) {
                            $mascota->persona()->associate( $personas->random() );
                            $mascota->save();
                        });
    }
}