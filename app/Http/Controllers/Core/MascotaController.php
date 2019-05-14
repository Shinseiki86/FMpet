<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use DataTables;

use App\Models\Mascota;
use App\Models\Persona;

class MascotaController extends Controller
{
	protected $route = 'Core.mascotas';
	protected $class = Mascota::class;

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Muestra una lista de los registros.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view($this->route.'.index');
	}

	/**
	 * Retorna json para Datatable.
	 *
	 * @return json
	 */
	public function getData()
	{
		$model = new $this->class;

		$PERS_NOMBREAPELLIDO = expression_concat([
			'PERS_NOMBRE',
			'PERS_APELLIDO',
			], 'PERS_NOMBREAPELLIDO');

		$query = Mascota::leftJoin('PERSONAS', 'PERSONAS.PERS_ID', 'MASCOTAS.PERS_ID')
						->select([
							'MASC_ID',
							'MASC_NOMBRE',
							'MASC_EDAD',
							$PERS_NOMBREAPELLIDO,
							'MASC_CREADOPOR',
						]);
		return Datatables::eloquent($query)
			->addColumn('action', function($row) use ($model) {
				return parent::buttonEdit($row, $model).
					parent::buttonDelete($row, $model, 'MASC_NOMBRE');
			}, false)->make(true);
	}

	/**
	 * Muestra el formulario para crear un nuevo registro.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view($this->route.'.create', $this->getParameters());
	}

	/**
	 * Guarda el registro nuevo en la base de datos.
	 *
	 * @return Response
	 */
	public function store()
	{
		parent::storeModel();
	}


	/**
	 * Muestra el formulario para editar un registro en particular.
	 *
	 * @param  int  $MASC_ID
	 * @return Response
	 */
	public function edit($MASC_ID)
	{
		// Se obtiene el registro
		$mascota = Mascota::findOrFail($MASC_ID);

		// Muestra el formulario de edición y pasa el registro a editar
		return view($this->route.'.edit', compact('mascota')+$this->getParameters());
	}


	/**
	 * Actualiza un registro en la base de datos.
	 *
	 * @param  int  $MASC_ID
	 * @return Response
	 */
	public function update($MASC_ID)
	{
		parent::updateModel($MASC_ID);
	}

	/**
	 * Elimina un registro de la base de datos.
	 *
	 * @param  int  $MASC_ID
	 * @return Response
	 */
	public function destroy($MASC_ID)
	{
		parent::destroyModel($MASC_ID);
	}


	/**
	 * Se obtienen variables que se requieren para construir el formulario (Listas para selects)
	 *
	 * @param  int  $MASC_ID
	 * @return Response
	 */
	private function getParameters($value='')
	{
		//Se crea un array con Personas disponibles
		$arrPersonas = model_to_array(Persona::class, expression_concat([
			'PERS_NUMEROIDENTIFICACION',
			'PERS_NOMBRE',
			'PERS_APELLIDO',
			], 'PERS_NOMBREAPELLIDO')
		);

		return compact('arrPersonas');
	}

}

