<?php

use Illuminate\Database\Seeder;
use App\Models\PersonaTipo;
use App\Models\PublicacionTipo;
use App\Models\PublicacionEstado;

class TiposTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        $this->command->info('---Seeder Tipos y Estados');

		$personaTipos = [
			['PETI_NOMBRE' => 'NATURAL'],
			['PETI_NOMBRE' => 'JURIDICA'],
		];
		foreach ($personaTipos as $tipo) {
			PersonaTipo::create($tipo);
		}

		$publicacionTipos = [
			['PUTI_NOMBRE' => 'xxx'],
			['PUTI_NOMBRE' => 'xxxxxx'],
		];
		foreach ($publicacionTipos as $tipo) {
			PublicacionTipo::create($tipo);
		}

		$publicacionEstados = [
			['PUES_NOMBRE' => 'xxx'],
			['PUES_NOMBRE' => 'xxxxxx'],
		];
		foreach ($publicacionEstados as $estado) {
			PublicacionEstado::create($estado);
		}
	}
}
