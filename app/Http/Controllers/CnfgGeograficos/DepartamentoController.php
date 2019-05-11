<?php

namespace App\Http\Controllers\CnfgGeograficos;

use App\Http\Controllers\Controller;
use DataTables;

use App\Models\Departamento;

class DepartamentoController extends Controller
{
	protected $route = 'CnfgGeograficos.departamentos';
	protected $class = Departamento::class;

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
		$query = Departamento::leftJoin('PAISES', 'PAISES.PAIS_ID', 'DEPARTAMENTOS.PAIS_ID')
						->select([
							'DEPA_ID',
							'DEPA_CODIGO',
							'DEPA_NOMBRE',
							'PAISES.PAIS_NOMBRE',
							'DEPA_CREADOPOR'
						]);

		return Datatables::eloquent($query)
			->addColumn('action', function($row) use ($model) {
				return parent::buttonEdit($row, $model).
					parent::buttonDelete($row, $model, 'DEPA_NOMBRE');
			}, false)->make(true);
	}


	/**
	 * Muestra el formulario para crear un nuevo registro.
	 *
	 * @return Response
	 */
	public function create()
	{
		//Se crea un array con los países disponibles
		$arrPaises = model_to_array(Pais::class, 'PAIS_NOMBRE');

		return view($this->route.'.create', compact('arrPaises'));
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
	 * @param  int  $DEPA_ID
	 * @return Response
	 */
	public function edit($DEPA_ID)
	{
		// Se obtiene el registro
		$departamento = Departamento::findOrFail($DEPA_ID);

		//Se crea un array con los países disponibles
		$arrPaises = model_to_array(Pais::class, 'PAIS_NOMBRE');

		// Muestra el formulario de edición y pasa el registro a editar
		return view($this->route.'.edit', compact('departamento', 'arrPaises'));
	}


	/**
	 * Actualiza un registro en la base de datos.
	 *
	 * @param  int  $DEPA_ID
	 * @return Response
	 */
	public function update($DEPA_ID)
	{
		parent::updateModel($DEPA_ID);
	}

	/**
	 * Elimina un registro de la base de datos.
	 *
	 * @param  int  $DEPA_ID
	 * @return Response
	 */
	public function destroy($DEPA_ID)
	{
		parent::destroyModel($DEPA_ID);
	}


}

