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
		if($this->routeApi){
			$data = $this->buildQuery()->get();
			return response()->json([
				'data'   => $data,
				'status' => false,
				'mensaje'=>'OK'
			]);
		} else {
			return view($this->route.'.index');
		}
	}

	private function buildQuery()
	{
		$PERS_NOMBREAPELLIDO = expression_concat([
			'PERS_NOMBRE',
			'PERS_APELLIDO',
			], 'PERS_NOMBREAPELLIDO'
		);

		return Publicacion::with([
				'mascota:MASC_ID,MASC_NOMBRE,MASC_EDAD',
				'barrio:BARR_ID,BARR_NOMBRE',
			])
			->leftJoin('PERSONAS', 'PERSONAS.PERS_ID', 'PUBLICACIONES.PERS_ID')
			->select([
				'PUBL_ID',
				'PUBL_TITULO',
				'PUBL_DESCRIPCION',
				'PUBLICACIONES.PERS_ID',
				$PERS_NOMBREAPELLIDO,
				'PUBL_LATITUD',
				'PUBL_LONGITUD',
				'PUES_ID',
				'PUTI_ID',
				'MASC_ID',
				'BARR_ID',
				'PUBL_CREADOPOR',
			]);
	}

	/**
	 * Retorna json para Datatable.
	 *
	 * @return json
	 */
	public function getData()
	{
		$model = new $this->class;

		$query = $this->buildQuery();

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
		return parent::storeModel();
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
		$publicacion = Publicacion::with('barrio.ciudad.departamento')->findOrFail($PUBL_ID);

		// Muestra el formulario de edición y pasa el registro a editar
		return view($this->route.'.edit', compact('publicacion')+$this->getParameters($publicacion));
	}


	/**
	 * Actualiza un registro en la base de datos.
	 *
	 * @param  int  $PUBL_ID
	 * @return Response
	 */
	public function update($PUBL_ID)
	{
		return parent::updateModel($PUBL_ID);
	}

	/**
	 * Elimina un registro de la base de datos.
	 *
	 * @param  int  $PUBL_ID
	 * @return Response
	 */
	public function destroy($PUBL_ID)
	{
		return parent::destroyModel($PUBL_ID);
	}


	/**
	 * Se obtienen variables que se requieren para construir el formulario (Listas para selects)
	 *
	 * @param  int  $PUBL_ID
	 * @return Response
	 */
	private function getParameters(Publicacion $publicacion = null)
	{
		//Se crea un array con Personas disponibles
		$arrPersonas = model_to_array(Persona::class, expression_concat([
			'PERS_NUMEROIDENTIFICACION',
			'PERS_NOMBRE',
			'PERS_APELLIDO',
			], 'PERS_NOMBREAPELLIDO')
		);

		$arrPubEstados = model_to_array(PublicacionEstado::class, 'PUES_NOMBRE');
		$arrPubTipos = model_to_array(PublicacionTipo::class, 'PUTI_NOMBRE');
		$arrMascotas = model_to_array(Mascota::class, 'MASC_NOMBRE');

		if(isset($publicacion)){
			$arrBarios = model_to_array(
				Barrio::class, 'BARR_NOMBRE',
				[['CIUD_ID','=',$publicacion->barrio->CIUD_ID]]
			);
			$arrCiudades = model_to_array(
				Ciudad::class, 'CIUD_NOMBRE',
				[['DEPA_ID','=',$publicacion->barrio->ciudad->DEPA_ID]]
			);
			$arrDepartamentos = model_to_array(
				Departamento::class, 'DEPA_NOMBRE',
				[['PAIS_ID','=',$publicacion->barrio->ciudad->departamento->PAIS_ID]]
			);
		} else {
			$arrBarios = null;
			$arrCiudades = null;
			$arrDepartamentos = null;
		}

		$arrPaises = model_to_array(Pais::class, 'PAIS_NOMBRE');

		return compact('arrPersonas','arrPubEstados','arrPubTipos','arrMascotas','arrCiudades');
	}

}

