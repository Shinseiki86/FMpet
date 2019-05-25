<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
	protected $route = 'auth.users';
	protected $class = User::class;

	public function __construct()
	{
        $this->routeApi = request()->wantsJson();
        $this->middleware('auth:api',  ['except' => ['store']]);
	}

	/**
	 * Muestra una lista de los registros.
	 *
	 * @return Response
	 */
	public function index()
	{
		//Se obtienen todos los registros.
		$users = User::with('roles')->get();
		//Se carga la vista y se pasan los registros
		return view($this->route.'.index', compact('users'));
	}



	/**
	 * Guarda el registro nuevo en la base de datos.
	 *
	 * @return Response
	 */
	public function store()
	{
		//Datos recibidos desde la vista.
		$data = $this->getRequest();
		$data['username'] = $data['email'];
		$data['roles'] = [Role::EMPLEADO];
		$data['USER_CREADOPOR'] = 'API';

		//Se valida que los datos recibidos cumplan los requerimientos necesarios.
		$validator = $this->validateRules($data);


		if($validator->passes()){
			// $class = get_model($this->class);

			if(array_has($data, 'password'))
				$data['password'] = bcrypt($data['password']);

			$model = $this->class::create($data);
			$model = $this->postCreateOrUpdate($model);
			//$model->save();

			//Se crean las relaciones
			$this->updateRelations($model, $data);

			$this->nameClassClass = str_upperspace(class_basename($model));

			// redirecciona al index de controlador
			return response()->json([
				'data'   => $model,
				'status' => false,
				'message'=>'OK'
			]);
		} else {
			return response()->json([
				'data'   => $validator->errors(),
				'status' => false,
				'message'=>'ERR'
			]);
		}
	}


	/**
	 * Actualiza un registro en la base de datos.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//Datos recibidos desde la vista.
		$data = $this->getRequest();
		$data['roles'] = [Role::EMPLEADO];
		$data['USER_MODIFICADOPOR'] = 'API';

		//Se valida que los datos recibidos cumplan los requerimientos necesarios.
		$validator = $this->validateRules($data, $id);

		if($validator->passes()){
			$class = get_model($this->class);

			// Se obtiene el registro
			$model = $class::findOrFail($id);
			//y se actualiza con los datos recibidos.
			$model->fill($data);
			$model = $this->postCreateOrUpdate($model);
			$model->save();

			//Se crean las relaciones
			// $this->storeRelations($model, $relations);
			$this->updateRelations($model, $data);
			$this->nameClassClass = str_upperspace(class_basename($model));
			$msg = [$this->nameClassClass.' '.$id.' modificado exitosamente.', 'success'];

			// redirecciona al index de controlador
			return response()->json([
				'data'   => $data,
				'status' => $msg[1],
				'message'=> $msg[0]
			]);
		} else {
			return response()->json([
				'data'   => $validator->errors(),
				'status' => 'danger',
				'message'=> 'Datos presentan inconsistencias.'
			]);
		}
	}

	/**
	 * Elimina un registro de la base de datos.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		return parent::destroyModel($id);
	}

}
