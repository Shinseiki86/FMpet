<?php
    
use Illuminate\Database\Seeder;

use App\Models\Publicacion;
use App\Models\PublicacionTipo;
use App\Models\PublicacionEstado;
use App\Models\Persona;
use App\Models\Barrio;

use App\Models\Comentario;
use App\Models\Adjunto;

class PublicacionesTableSeeder extends Seeder {


    public function run() {
        //*********************************************************************
        $this->command->info('--- Seeder Publicaciones');


        $publicacionTipos = [
            ['PUTI_NOMBRE' => 'URGENTE', 'PUTI_CLASS'=>'danger'],
            ['PUTI_NOMBRE' => 'ALERTA', 'PUTI_CLASS'=>'warning'],
            ['PUTI_NOMBRE' => 'NORMAL', 'PUTI_CLASS'=>'info'],
        ];
        foreach ($publicacionTipos as $tipo) {
            PublicacionTipo::create($tipo);
        }

        $publicacionEstados = [
            ['PUES_NOMBRE' => 'PUBLICADO'],
            ['PUES_NOMBRE' => 'CERRADO'],
            ['PUES_NOMBRE' => 'CANCELADO'],
            ['PUES_NOMBRE' => 'BORRADOR'],
        ];
        foreach ($publicacionEstados as $estado) {
            PublicacionEstado::create($estado);
        }

        $publicacionEstados = [
            ['PUES_NOMBRE' => 'PUBLICADO'],
            ['PUES_NOMBRE' => 'CERRADO'],
            ['PUES_NOMBRE' => 'CANCELADO'],
            ['PUES_NOMBRE' => 'BORRADOR'],
        ];
        foreach ($publicacionEstados as $estado) {
            PublicacionEstado::create($estado);
        }

        $personas = Persona::with('mascotas')->has('mascotas')->get();
        $barrios = Barrio::all();
        $pubTipos = PublicacionTipo::all();
        $pubEstados = PublicacionEstado::all();

        $publicaciones = factory(Publicacion::class)->times(1000)->make()
                        ->each(function ($publ) use ($personas,$barrios,$pubTipos,$pubEstados) {
                            $pers = $personas->random();
                            $publ->persona()->associate( $pers );
                            $publ->mascota()->associate( $pers->mascotas->random() );
                            $publ->barrio()->associate( $barrios->random() );
                            $publ->publicacionEstado()->associate( $pubEstados->random() );
                            $publ->publicacionTipo()->associate( $pubTipos->random() );
                            $publ->save();

                        });

        $coments = factory(Comentario::class)->times(4000)->make()
            ->each(function ($coment) use ($publicaciones) {
                $coment->publicacion()->associate( $publicaciones->random() );
                $coment->save();
        });

        $pub = $publicaciones->first();
        Adjunto::create(['ADJU_PATH'=>'Adj_1.jpg', 'PUBL_ID'=>$pub->PUBL_ID]);
        Adjunto::create(['ADJU_PATH'=>'Adj_2.jpg', 'PUBL_ID'=>$pub->PUBL_ID]);
        Adjunto::create(['ADJU_PATH'=>'Adj_3.jpg', 'PUBL_ID'=>$pub->PUBL_ID]);
        Adjunto::create(['ADJU_PATH'=>'Adj_4.jpg', 'PUBL_ID'=>2]);
        Adjunto::create(['ADJU_PATH'=>'Adj_5.jpg', 'PUBL_ID'=>2]);

        $com = $pub->comentarios->first();
        Adjunto::create(['ADJU_PATH'=>'Adj_6.jpg', 'COME_ID'=>$com->COME_ID]);
    }
}