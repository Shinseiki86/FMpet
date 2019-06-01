<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersAvatarTable extends Migration
{
	private $nomTabla = 'users';

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
        echo '- Agregando columna avatar en '.$this->nomTabla.'...' . PHP_EOL;
        Schema::table($this->nomTabla, function (Blueprint $table) {
            $table->string('avatar')->nullable()
                ->comment('Foto usuario');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        echo '- Eliminando columna avatar en '.$this->nomTabla.'...' . PHP_EOL;
        Schema::table($this->nomTabla, function (Blueprint $table) {
            $table->dropColumn('avatar');
        });
    }
 
}
