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
	protected $requestExcept = ['MASC_FOTO'];

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
		$query = $this->buildQuery();
		if($this->routeApi){
			$attributes = (new $this->class)->getFillable();
			foreach (request()->all() as $key => $value) {
				if(in_array($key, $attributes))
					$query = $query->where('MASCOTAS.'.$key, $value);
			}
			$limit = request()->get('limit');
			$query = isset($limit) ? $query->take($limit) : $query->take(10);

			return response()->json([
				'data'   => $query->get(), //->simplePaginate(5)
				'status' => true,
				'mensaje'=> 'OK'
			]);
		} else {
			//return view($this->route.'.index');
			return view($this->route.'.index', ['publicaciones'=>$query->paginate(5)]);
		}
	}

	private function buildQuery()
	{
		$PERS_NOMBREAPELLIDO = expression_concat([
			'PERS_NOMBRE',
			'PERS_APELLIDO',
			], 'PERS_NOMBREAPELLIDO'
		);

		$query = Mascota::leftJoin('PERSONAS', 'PERSONAS.PERS_ID', 'MASCOTAS.PERS_ID')//with(['persona:PERS_ID,PERS_NOMBRE,PERS_APELLIDO'])
			->select([
				'MASC_ID',
				'MASC_NOMBRE',
				'MASC_TIPO',
				'MASC_EDAD',
				'MASC_FOTO',
				$PERS_NOMBREAPELLIDO,
				'MASC_DESCRIPCION',
				'MASC_CREADOPOR',
			]);
		return $query;
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
		return parent::storeModel();
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
		return parent::updateModel($MASC_ID);
	}


	/**
	 * {@inheritDoc}
	 */
	protected function postCreateOrUpdate($model)
	{
		$filename = 'Masc_'.$model->MASC_ID.'_'.\Carbon\Carbon::now()->timestamp.'.';
		$path = public_path('mascotas');

		if(request()->hasFile('MASC_FOTO')){
			$file = request()->file('MASC_FOTO');
			$filename = $filename.$file->getClientOriginalExtension();
			$putFile = $file->move($path, $filename);
		} else if(request()->has('MASC_FOTO')) {
			$photo_base64 = request()->get('MASC_FOTO');
			if(isset($photo_base64)){
				$data = explode(',', $photo_base64);
				$file = base64_decode($data[1]);
				$filename = $filename.'png';
				if (file_exists($path.'/'.$filename))
					\File::delete($path.'/'.$filename);
				$putFile = \File::put($path.'/'.$filename,  $file);
			}
		}

		if(isset($putFile))
			$model->update(['MASC_FOTO'=>asset('mascotas/'.$filename)]);
		
		return $model;
	}

	/**
	 * Elimina un registro de la base de datos.
	 *
	 * @param  int  $MASC_ID
	 * @return Response
	 */
	public function destroy($MASC_ID)
	{
		return parent::destroyModel($MASC_ID);
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

	/**
	 * Dashboard: Cantidad de mascotas por barrio.
	 *
	 * @return json
	 */
	public function getMascotasPorBarrio()
	{
		$masc = Mascota::join('BARRIOS', 'BARRIOS.BARR_ID', 'MASCOTAS.BARR_ID')
						;

		return $masc->get()->toJson();
	}
}

