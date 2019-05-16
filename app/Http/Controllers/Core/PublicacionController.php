<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use DataTables;

use App\Models\Publicacion;
use App\Models\Persona;
use App\Models\Pais;
use App\Models\Departamento;
use App\Models\Ciudad;
use App\Models\Barrio;
use App\Models\Role;

class PublicacionController extends Controller
{
	protected $route = 'Core.publicaciones';
	protected $class = Publicacion::class;

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


		$query = Publicacion::with(['mascota', 'barrio.ciudad.departamento.pais'])
			->leftJoin('PERSONAS', 'PERSONAS.PERS_ID', 'PUBLICACIONES.PERS_ID')
			//->leftJoin('MASCOTAS', 'MASCOTAS.MASC_ID', 'PUBLICACIONES.MASC_ID')
			->select([
				'PUBL_TITULO',
				'PUBL_DESCRIPCION',
				$PERS_NOMBREAPELLIDO,
				'PUBL_LATITUD',
				'PUBL_LONGITUD',
				'PUBL_CREADOPOR',
			]);

		return Datatables::eloquent($query)
			->filterColumn('PERS_NOMBREAPELLIDO', function($query, $keyword){
				$query->leftJoin('PERSONAS', 'PERSONAS.PERS_ID', 'MASCOTAS.PERS_ID')
					->where(expression_concat(['PERS_NOMBRE','PERS_APELLIDO']),'like','%'.mb_strtoupper($keyword).'%');
			})
			->addColumn('action', function($row) use ($model) {
				return parent::buttonEdit($row, $model).
					parent::buttonDelete($row, $model, 'PUBL_NOMBRE');
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
	 * @param  int  $PUBL_ID
	 * @return Response
	 */
	public function edit($PUBL_ID)
	{
		// Se obtiene el registro
		$publicacion = Publicacion::findOrFail($PUBL_ID);

		// Muestra el formulario de edición y pasa el registro a editar
		return view($this->route.'.edit', compact('publicacion')+$this->getParameters());
	}


	/**
	 * Actualiza un registro en la base de datos.
	 *
	 * @param  int  $PUBL_ID
	 * @return Response
	 */
	public function update($PUBL_ID)
	{
		parent::updateModel($PUBL_ID);
	}

	/**
	 * Elimina un registro de la base de datos.
	 *
	 * @param  int  $PUBL_ID
	 * @return Response
	 */
	public function destroy($PUBL_ID)
	{
		parent::destroyModel($PUBL_ID);
	}


	/**
	 * Se obtienen variables que se requieren para construir el formulario (Listas para selects)
	 *
	 * @param  int  $PUBL_ID
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

