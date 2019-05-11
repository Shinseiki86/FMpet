<?php

namespace App\Http\Controllers\CnfgGeograficos;

use App\Http\Controllers\Controller;
use DataTables;

use App\Models\Ciudad;
use App\Models\Departamento;

class CiudadController extends Controller
{
	protected $route = 'CnfgGeograficos.ciudades';
	protected $class = Ciudad::class;

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
		$query = Ciudad::leftJoin('DEPARTAMENTOS', 'DEPARTAMENTOS.DEPA_ID', 'CIUDADES.DEPA_ID')
						->select([
							'CIUD_ID',
							'CIUD_CODIGO',
							'CIUD_NOMBRE',
							'DEPARTAMENTOS.DEPA_CODIGO',
							'DEPARTAMENTOS.DEPA_NOMBRE',
							'CIUD_CREADOPOR',
						]);
		return Datatables::eloquent($query)
			->addColumn('action', function($row) use ($model) {
				return parent::buttonEdit($row, $model).
					parent::buttonDelete($row, $model, 'CIUD_NOMBRE');
			}, false)->make(true);
	}

	/**
	 * Muestra el formulario para crear un nuevo registro.
	 *
	 * @return Response
	 */
	public function create()
	{
		//Se crea un array con los departamentos disponibles
		$arrDepartamentos = model_to_array(Departamento::class, 'DEPA_NOMBRE');

		return view($this->route.'.create', compact('arrDepartamentos'));
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
	 * @param  int  $CIUD_ID
	 * @return Response
	 */
	public function edit($CIUD_ID)
	{
		// Se obtiene el registro
		$ciudad = Ciudad::findOrFail($CIUD_ID);

		//Se crea un array con los departamentos disponibles
		$arrDepartamentos = model_to_array(Departamento::class, 'DEPA_NOMBRE');

		// Muestra el formulario de edición y pasa el registro a editar
		return view($this->route.'.edit', compact('ciudad', 'arrDepartamentos'));
	}


	/**
	 * Actualiza un registro en la base de datos.
	 *
	 * @param  int  $CIUD_ID
	 * @return Response
	 */
	public function update($CIUD_ID)
	{
		parent::updateModel($CIUD_ID);
	}

	/**
	 * Elimina un registro de la base de datos.
	 *
	 * @param  int  $CIUD_ID
	 * @return Response
	 */
	public function destroy($CIUD_ID)
	{
		parent::destroyModel($CIUD_ID);
	}

}

