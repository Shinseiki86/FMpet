<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use DataTables;

use App\Models\Persona;
use App\Models\Mascota;

class PersonaController extends Controller
{
	protected $route = 'Core.personas';
	protected $class = Persona::class;

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
			], 'PERS_NOMBREAPELLIDO'
		);

		$query = Persona::with('mascotas')
			->select([
				'PERS_ID',
				'PERS_NUMEROIDENTIFICACION',
				$PERS_NOMBREAPELLIDO,
				'PERS_TELEFONO',
				'PERS_DIRECCION',
				'PERS_CORREO',
				'PERS_CREADOPOR',
			]);

		return Datatables::eloquent($query)
            ->addColumn('count_mascotas', function(Persona $pers) {
                return $pers->mascotas->count();
            })
			->filterColumn('PERS_NOMBREAPELLIDO', function($query, $keyword){
				$query->where(expression_concat(['PERS_NOMBRE','PERS_APELLIDO']),'like','%'.mb_strtoupper($keyword).'%');
			})
			->addColumn('action', function($row) use ($model) {
				return parent::buttonEdit($row, $model).
					parent::buttonDelete($row, $model, 'PERS_NUMEROIDENTIFICACION');
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
	 * @param  int  $PERS_ID
	 * @return Response
	 */
	public function edit($PERS_ID)
	{
		// Se obtiene el registro
		$persona = Persona::findOrFail($PERS_ID);

		// Muestra el formulario de edición y pasa el registro a editar
		return view($this->route.'.edit', compact('persona')+$this->getParameters());
	}


	/**
	 * Actualiza un registro en la base de datos.
	 *
	 * @param  int  $PERS_ID
	 * @return Response
	 */
	public function update($PERS_ID)
	{
		parent::updateModel($PERS_ID);
	}

	/**
	 * Elimina un registro de la base de datos.
	 *
	 * @param  int  $PERS_ID
	 * @return Response
	 */
	public function destroy($PERS_ID)
	{
		parent::destroyModel($PERS_ID);
	}


	/**
	 * Se obtienen variables que se requieren para construir el formulario (Listas para selects)
	 *
	 * @param  int  $PERS_ID
	 * @return Response
	 */
	private function getParameters()
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

