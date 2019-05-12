<?php

namespace App\Http\Controllers\CnfgGeograficos;

use App\Http\Controllers\Controller;
use DataTables;

use App\Models\Barrio;
use App\Models\Ciudad;

class BarrioController extends Controller
{
	protected $route = 'CnfgGeograficos.barrios';
	protected $class = Barrio::class;

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
		$query = Barrio::leftJoin('CIUDADES', 'CIUDADES.CIUD_ID', 'BARRIOS.CIUD_ID')
						->select([
							'BARR_ID',
							'BARR_CODIGO',
							'BARR_NOMBRE',
							'BARR_ESTRATO',
							'CIUDADES.CIUD_CODIGO',
							'CIUDADES.CIUD_NOMBRE',
							'BARR_CREADOPOR',
						]);
		return Datatables::eloquent($query)
			->addColumn('action', function($row) use ($model) {
				return parent::buttonEdit($row, $model).
					parent::buttonDelete($row, $model, 'BARR_NOMBRE');
			}, false)->make(true);
	}

	/**
	 * Muestra el formulario para crear un nuevo registro.
	 *
	 * @return Response
	 */
	public function create()
	{
		$arrCiudades = model_to_array(Ciudad::class, 'CIUD_NOMBRE');

		return view($this->route.'.create', compact('arrCiudades'));
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
	 * @param  int  $BARR_ID
	 * @return Response
	 */
	public function edit($BARR_ID)
	{
		// Se obtiene el registro
		$barrio = Barrio::findOrFail($BARR_ID);

		//Se crea un array con los Ciudades disponibles
		$arrCiudades = model_to_array(Ciudad::class, 'CIUD_NOMBRE');

		// Muestra el formulario de edición y pasa el registro a editar
		return view($this->route.'.edit', compact('barrio', 'arrCiudades'));
	}


	/**
	 * Actualiza un registro en la base de datos.
	 *
	 * @param  int  $BARR_ID
	 * @return Response
	 */
	public function update($BARR_ID)
	{
		parent::updateModel($BARR_ID);
	}

	/**
	 * Elimina un registro de la base de datos.
	 *
	 * @param  int  $BARR_ID
	 * @return Response
	 */
	public function destroy($BARR_ID)
	{
		parent::destroyModel($BARR_ID);
	}

}

