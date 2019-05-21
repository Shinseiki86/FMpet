<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdjuntosTable extends Migration
{
    
    private $nomTabla = 'ADJUNTOS';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $commentTabla = 'ADJUNTOS: ';

        echo '- Creando tabla '.$this->nomTabla.'...' . PHP_EOL;
        Schema::create($this->nomTabla, function (Blueprint $table) {
            $table->increments('ADJU_ID')->comment('Valor autonumérico, llave primaria de la tabla.');

            $table->string('ADJU_PATH', 255)->comment('PATH');
            //$table->boolean('ADJU_ISPUBLICATION')->default(true)->comment('Determina si el item corresponde a una publicación o a un comentario.');

            $table->unsignedInteger('PUBL_ID')->nullable()->comment('Llave foranea con PUBLICACIONES. Si es nulo, entonces debe estar asignado a un comentario.');
            $table->unsignedInteger('COME_ID')->nullable()->comment('Llave foranea con COMENTARIOS. Si es nulo, entonces debe estar asignado a una publicación.');
            
            //Traza
            $table->string('ADJU_CREADOPOR')
                ->comment('Usuario que creó el registro en la tabla');
            $table->timestamp('ADJU_FECHACREADO')
                ->comment('Fecha en que se creó el registro en la tabla.');
            $table->string('ADJU_MODIFICADOPOR')->nullable()
                ->comment('Usuario que realizó la última modificación del registro en la tabla.');
            $table->timestamp('ADJU_FECHAMODIFICADO')->nullable()
                ->comment('Fecha de la última modificación del registro en la tabla.');
            $table->string('ADJU_ELIMINADOPOR')->nullable()
                ->comment('Usuario que eliminó el registro en la tabla.');
            $table->timestamp('ADJU_FECHAELIMINADO')->nullable()
                ->comment('Fecha en que se eliminó el registro en la tabla.');

            //Relación con tabla PUBLICACIONES
            $table->foreign('PUBL_ID')->references('PUBL_ID')
                ->on('PUBLICACIONES')->onDelete('cascade')->onUpdate('cascade');
            //Relación con tabla COMENTARIOS
            $table->foreign('COME_ID')->references('COME_ID')
                ->on('COMENTARIOS')->onDelete('cascade')->onUpdate('cascade');

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
