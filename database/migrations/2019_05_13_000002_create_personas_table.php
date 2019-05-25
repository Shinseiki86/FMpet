<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    
    private $nomTabla = 'PERSONAS';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $commentTabla = 'PERSONAS: ';

        echo '- Creando tabla '.$this->nomTabla.'...' . PHP_EOL;
        Schema::create($this->nomTabla, function (Blueprint $table) {
            $table->increments('PERS_ID')->comment('Valor autonumérico, llave primaria.');

            $table->unsignedBigInteger('PERS_NUMEROIDENTIFICACION')->unique()->comment('');
            $table->string('PERS_NOMBRE', 50)->comment('Nombres de la persona');
            $table->string('PERS_APELLIDO', 50)->comment('Apellidos de la persona');
            $table->unsignedBigInteger('PERS_TELEFONO')->comment('Número de teléfono');
            $table->string('PERS_DIRECCION', 100)->nullable()->comment('Dirección de residencia');
            $table->string('PERS_CORREO', 320)->nullable()->comment('Correo electrónico');

            $table->unsignedInteger('USER_ID')->nullable()->comment('Llave foranea con users');
            $table->unsignedInteger('PETI_ID')->comment('Llave foranea con PERSONAS_TIPOS');

            //Traza
            $table->string('PERS_CREADOPOR')
                ->comment('Usuario que creó el registro en la tabla');
            $table->timestamp('PERS_FECHACREADO')
                ->comment('Fecha en que se creó el registro en la tabla.');
            $table->string('PERS_MODIFICADOPOR')->nullable()
                ->comment('Usuario que realizó la última modificación del registro en la tabla.');
            $table->timestamp('PERS_FECHAMODIFICADO')->nullable()
                ->comment('Fecha de la última modificación del registro en la tabla.');
            $table->string('PERS_ELIMINADOPOR')->nullable()
                ->comment('Usuario que eliminó el registro en la tabla.');
            $table->timestamp('PERS_FECHAELIMINADO')->nullable()
                ->comment('Fecha en que se eliminó el registro en la tabla.');

            //Relación con tabla PERSONAS_TIPOS
            $table->foreign('PETI_ID')->references('PETI_ID')
                ->on('PERSONAS_TIPOS')->onDelete('cascade')->onUpdate('cascade');
            //Relación con tabla users
            $table->foreign('USER_ID')->references('id')
                ->on('users')->onDelete('cascade')->onUpdate('cascade');

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
