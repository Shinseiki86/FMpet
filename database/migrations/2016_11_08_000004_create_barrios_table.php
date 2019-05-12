<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarriosTable extends Migration
{
    
    private $nomTabla = 'BARRIOS';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $commentTabla = 'BARRIOS: contiene los barrios del territorio nacional';

        echo '- Creando tabla '.$this->nomTabla.'...' . PHP_EOL;
        Schema::create($this->nomTabla, function (Blueprint $table) {
            $table->increments('BARR_ID')
                ->comment('Valor autonumérico, llave primaria de la tabla barrios.');

            $table->string('BARR_CODIGO', 6)
                ->comment('codigo del barrio de acuerdo a clasificación DANE');

            $table->string('BARR_NOMBRE', 300)
                ->comment('Nombre del barrio');

            $table->unsignedTinyInteger('BARR_ESTRATO')->nullable()
                ->comment('Estrato socioeconómico');

            $table->unsignedInteger('CIUD_ID')
                ->comment('Llave foranea con CIUDADES');

            
            //Traza
            $table->string('BARR_CREADOPOR')
                ->comment('Usuario que creó el registro en la tabla');
            $table->timestamp('BARR_FECHACREADO')
                ->comment('Fecha en que se creó el registro en la tabla.');
            $table->string('BARR_MODIFICADOPOR')->nullable()
                ->comment('Usuario que realizó la última modificación del registro en la tabla.');
            $table->timestamp('BARR_FECHAMODIFICADO')->nullable()
                ->comment('Fecha de la última modificación del registro en la tabla.');
            $table->string('BARR_ELIMINADOPOR')->nullable()
                ->comment('Usuario que eliminó el registro en la tabla.');
            $table->timestamp('BARR_FECHAELIMINADO')->nullable()
                ->comment('Fecha en que se eliminó el registro en la tabla.');

            //Relación con tabla DEPARTAMENTOS
            $table->foreign('CIUD_ID')
                ->references('CIUD_ID')
                ->on('CIUDADES')
                ->onDelete('cascade')
                ->onUpdate('cascade');

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
