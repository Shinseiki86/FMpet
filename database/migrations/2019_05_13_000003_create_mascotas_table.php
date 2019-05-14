<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMascotasTable extends Migration
{
    
    private $nomTabla = 'MASCOTAS';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $commentTabla = 'MASCOTAS: ';

        echo '- Creando tabla '.$this->nomTabla.'...' . PHP_EOL;
        Schema::create($this->nomTabla, function (Blueprint $table) {
            $table->increments('MASC_ID')->comment('Valor autonumérico, llave primaria.');

            $table->string('MASC_NOMBRE', 50)->comment('Nombres de la macota');
            $table->unsignedTinyInteger('MASC_EDAD')->comment('');
            $table->unsignedInteger('PERS_ID')->comment('Llave foranea con PERSONAS');

            //Traza
            $table->string('MASC_CREADOPOR')
                ->comment('Usuario que creó el registro en la tabla');
            $table->timestamp('MASC_FECHACREADO')
                ->comment('Fecha en que se creó el registro en la tabla.');
            $table->string('MASC_MODIFICADOPOR')->nullable()
                ->comment('Usuario que realizó la última modificación del registro en la tabla.');
            $table->timestamp('MASC_FECHAMODIFICADO')->nullable()
                ->comment('Fecha de la última modificación del registro en la tabla.');
            $table->string('MASC_ELIMINADOPOR')->nullable()
                ->comment('Usuario que eliminó el registro en la tabla.');
            $table->timestamp('MASC_FECHAELIMINADO')->nullable()
                ->comment('Fecha en que se eliminó el registro en la tabla.');

            //Relación con tabla PERSONAS
            $table->foreign('PERS_ID')->references('PERS_ID')
                ->on('PERSONAS')->onDelete('cascade')->onUpdate('cascade');

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
