<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Validator;
use App\Models\User;
use App\Models\Role;
use App\Models\Persona;

class UserController extends Controller
{
	protected $route = 'auth.users';
	protected $class = User::class;
	protected $requestExcept = ['avatar'];

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
		$data['name'] = $data['nombres'].' '.$data['apellidos'];
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



			Persona::firstOrCreate([
				'PERS_NUMEROIDENTIFICACION'=>$model->cedula,
				'PERS_NOMBRE'   => $data['nombres'],
				'PERS_APELLIDO' => $data['apellidos'],
				'PERS_TELEFONO' => $data['telefono'],
				'PERS_DIRECCION'=> $data['direccion'],
				'PERS_CORREO'   => $model->email,
				//'PETI_ID'       => 1,
				'PERS_CREADOPOR'=> 'API',
				'USER_ID'       => $model->id,
			]);



			// redirecciona al index de controlador
			return response()->json([
				'data'   => $model,
				'status' => true,
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
		$data['username'] = \Auth::user()->username;
		$data['name'] = $data['nombres'].' '.$data['apellidos'];
		$data['roles'] = [Role::EMPLEADO];
		$data['USER_MODIFICADOPOR'] = 'API';

		//Se valida que los datos recibidos cumplan los requerimientos necesarios.
		$validator = $this->validateRules($data, $id);
		

		if($validator->passes()){
			$class = get_model($this->class);
			if(array_has($data, 'password'))
				$data['password'] = bcrypt($data['password']);

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


			$pers = Persona::find($model->PERS_ID);
			$pers->update([
				'PERS_NOMBRE'   => $data['nombres'],
				'PERS_APELLIDO' => $data['apellidos'],
				'PERS_TELEFONO' => $data['telefono'],
				'PERS_DIRECCION'=> $data['direccion'],
				//'PERS_CORREO'   => $model->email,
			]);


			// redirecciona al index de controlador
			return response()->json([
				'data'   => $model,
				'status' => true,
				'message'=> $msg[0]
			]);
		} else {
			return response()->json([
				'data'   => $validator->errors(),
				'status' => false,
				'message'=> 'Datos presentan inconsistencias.'
			]);
		}
	}

	/**
	 * {@inheritDoc}
	 */
	protected function postCreateOrUpdate($model)
	{

		$filename = 'User_'.$model->id.'.';
		$path = public_path('avatars');
		try{
			if(request()->hasFile('avatar')){
				$file = request()->file('avatar');
				$filename = $filename.$file->getClientOriginalExtension();
				$putFile = $file->move($path, $filename);
			} else if(request()->has('avatar')) {
				$data = explode(',', request()->get('avatar'));
				$file = base64_decode($data[1]);
				$filename = $filename.'png';
				$putFile = \File::put($path.'/'.$filename,  $file);
			}
		} catch(\Exception $e){
		}
		if(isset($putFile))
			$model->update(['avatar'=>asset('avatars/'.$filename)]);


		$model->roles()->sync([Role::EMPLEADO], true);
		$model = $model->load('persona','roles');
		return $model;
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


	/**
	 * 
	 *
	 * @param  int  $id
	 * @return response json
	 */
	public function getPersonaUser()
	{
		//$pers = Persona::where('USER_ID',$id_user)->first();
		$pers = \Auth::user()->load('persona');


		return response()->json([
			'data'   => $pers,
			'status' => true,
			'message'=> 'OK'
		]);
	}

}
