<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsPublicacionesComentariosTable extends Migration
{
    
    private $nomTabla = 'ITEMS_PUBLICACIONES_COMENTARIOS';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $commentTabla = 'ITEMS_PUBLICACIONES_COMENTARIOS: ';

        echo '- Creando tabla '.$this->nomTabla.'...' . PHP_EOL;
        Schema::create($this->nomTabla, function (Blueprint $table) {
            $table->increments('ITEM_ID')->comment('Valor autonumérico, llave primaria de la tabla.');

            $table->string('ITEM_URL', 100)->comment('');

            $table->unsignedInteger('ARTI_ID')->comment('Llave foranea con ARCHIVOS_TIPOS');
            $table->unsignedInteger('ITTI_ID')->comment('Llave foranea con ITEMS_TIPOS');
            $table->unsignedInteger('PUBL_ID')->nullable()->comment('Llave foranea con PUBLICACIONES');
            $table->unsignedInteger('COME_ID')->nullable()->comment('Llave foranea con COMENTARIOS');
            
            //Traza
            $table->string('ITEM_CREADOPOR')
                ->comment('Usuario que creó el registro en la tabla');
            $table->timestamp('ITEM_FECHACREADO')
                ->comment('Fecha en que se creó el registro en la tabla.');
            $table->string('ITEM_MODIFICADOPOR')->nullable()
                ->comment('Usuario que realizó la última modificación del registro en la tabla.');
            $table->timestamp('ITEM_FECHAMODIFICADO')->nullable()
                ->comment('Fecha de la última modificación del registro en la tabla.');
            $table->string('ITEM_ELIMINADOPOR')->nullable()
                ->comment('Usuario que eliminó el registro en la tabla.');
            $table->timestamp('ITEM_FECHAELIMINADO')->nullable()
                ->comment('Fecha en que se eliminó el registro en la tabla.');

            //Relación con tabla ARCHIVOS_TIPOS
            $table->foreign('ARTI_ID')->references('ARTI_ID')
                ->on('ARCHIVOS_TIPOS')->onDelete('cascade')->onUpdate('cascade');
            //Relación con tabla ITEMS_TIPOS
            $table->foreign('ITTI_ID')->references('ITTI_ID')
                ->on('ITEMS_TIPOS')->onDelete('cascade')->onUpdate('cascade');
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
