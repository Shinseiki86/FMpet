<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicacionesTable extends Migration
{
    
    private $nomTabla = 'PUBLICACIONES';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $commentTabla = 'PUBLICACIONES: ';

        echo '- Creando tabla '.$this->nomTabla.'...' . PHP_EOL;
        Schema::create($this->nomTabla, function (Blueprint $table) {

            $table->increments('PUBL_ID')->comment('Valor autonumérico, llave primaria de la tabla.');
            $table->string('PUBL_TITULO', 50)->comment('');
            $table->string('PUBL_DESCRIPCION', 300)->comment('');
            $table->double('PUBL_LATITUD')->comment('');
            $table->double('PUBL_LONGITUD')->comment('');
            //$table->ipAddress('PUBL_IP')->comment('IP desde la cual se realizó la publicación');

            $table->unsignedInteger('PERS_ID')->comment('Llave foranea con PERSONAS');
            $table->unsignedInteger('MASC_ID')->comment('Llave foranea con MASCOTAS');
            $table->unsignedInteger('PUES_ID')->comment('Llave foranea con PUBLICACIONES_ESTADOS');
            $table->unsignedInteger('PUTI_ID')->comment('Llave foranea con PUBLICACIONES_TIPOS');
            $table->unsignedInteger('BARR_ID')->comment('Llave foranea con BARRIOS');
            
            //Traza
            $table->string('PUBL_CREADOPOR')
                ->comment('Usuario que creó el registro en la tabla');
            $table->timestamp('PUBL_FECHACREADO')
                ->comment('Fecha en que se creó el registro en la tabla.');
            $table->string('PUBL_MODIFICADOPOR')->nullable()
                ->comment('Usuario que realizó la última modificación del registro en la tabla.');
            $table->timestamp('PUBL_FECHAMODIFICADO')->nullable()
                ->comment('Fecha de la última modificación del registro en la tabla.');
            $table->string('PUBL_ELIMINADOPOR')->nullable()
                ->comment('Usuario que eliminó el registro en la tabla.');
            $table->timestamp('PUBL_FECHAELIMINADO')->nullable()
                ->comment('Fecha en que se eliminó el registro en la tabla.');

            //Relación con tabla PERSONAS
            $table->foreign('PERS_ID')->references('PERS_ID')
                ->on('PERSONAS')->onDelete('cascade')->onUpdate('cascade');
            //Relación con tabla MASCOTAS
            $table->foreign('MASC_ID')->references('MASC_ID')
                ->on('MASCOTAS')->onDelete('cascade')->onUpdate('cascade');
            //Relación con tabla PUBLICACIONES_ESTADOS
            $table->foreign('PUES_ID')->references('PUES_ID')
                ->on('PUBLICACIONES_ESTADOS')->onDelete('cascade')->onUpdate('cascade');
            //Relación con tabla PUBLICACIONES_TIPOS
            $table->foreign('PUTI_ID')->references('PUTI_ID')
                ->on('PUBLICACIONES_TIPOS')->onDelete('cascade')->onUpdate('cascade');
            //Relación con tabla BARRIOS
            $table->foreign('BARR_ID')->references('BARR_ID')
                ->on('BARRIOS')->onDelete('cascade')->onUpdate('cascade');

        });
        
        if(env('DB_CONNECTION') == 'pgsql')
            DB::statement("COMMENT ON TABLE ".env('DB_SCHEMA').".\"".$this->nomTabla."\" IS '".$commentTabla."'");
        elseif(env('DB_CONNECTION') == 'mysql')
            DB::statement("ALTER TABLE ".$this->nomTabla." COMMENT = '".$commentTabla."'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        echo '- Borrando tabla '.$this->nomTabla.'...' . PHP_EOL;
        Schema::dropIfExists($this->nomTabla);
    }

}
