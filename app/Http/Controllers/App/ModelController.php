<?php
namespace App\Http\Controllers\App;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Route;



class ModelController extends Controller
{
	private $alerts = [];

	public function __construct()
	{
		//parent::__construct();
		$this->middleware('auth');
		$this->middleware('role:admin');
	}


	/**
	 * Crear registros por ajax cargados desde un archivo de excel.
	 *
	 */
	public function createFromAjax($modelClass, Request $request)
	{
		try{
			//Se obtiene clase del modelo
			$modelClass = $this->getmodel($modelClass);
			$prefix = strtoupper(substr($modelClass::CREATED_AT, 0, 5));

			//if(Entrust::can(''.$model))
			//Se obtienen las relaciones
			$relationships = $modelClass::getRelationships();
			$keysRelationships = array_keys($relationships);

			$data = $this->getRequest();

			//Se separan atributos de relaciones
			$relations = array_only($data, $keysRelationships);
			$attr = array_except($data+['CREADOPOR'=>auth()->user()->username], $keysRelationships);
			$attr = array_combine(
				array_map(function($k) use($prefix){ return $prefix.$k; }, array_keys($attr)),
				$attr
			);

			//$this->saveRelationsBelongsTo($relationships);
			//Los valores para las relaciones BelongsTo serán agregadas en el array principal, ya que si el campo es obligatorio generará error al realizarlo por ->associate(...)
			$relsBelongsTo = array_filter($relationships, function ($val){
								return ($val['type']=='BelongsTo');
					});

			foreach ($relsBelongsTo as $rel => $value) {
				$modelRel = get_model( $value['model']);
				$modelRel = new $modelRel;
				$filterKey = $modelRel::getFilterKey();

				$modelRel = $modelRel->where($filterKey, mb_strtoupper($relations[$rel]))->first();
				if($modelRel)
					$attr[$value['primaryKey']] =  $modelRel->getKey();
				else
					$this->alerts[] = 'No existe "'.$relations[$rel].'" en '.str_upperspace(class_basename($value['model']));
			}


			//Se busca registro entre los existentes y eliminados.
			$model = null;
			if($filterKey = $modelClass::getFilterKey()){
				$model = $modelClass::withTrashed()
								->where($filterKey, $attr[$filterKey])
								->get()->first();
			}

			$id = isset($model) ? $model->getKey() : 0;


			//Se valida que los datos cumplan las reglas definidas para el modelo
			$this->validator($attr, $modelClass::rules($id), $prefix);

			$msg = '';
			//Si el usuario existen en los eliminados...
			if( isset($model) ){
				//Se restaura usuario y se actualiza
				if($model->trashed()){
					$model->restore();
					$msg = ' restaurado y';
				}
				$model->update( $attr );
				$msg = $msg.' actualizado.';
			} else {
				//Sino, se crea usuario
				$model = new $modelClass( $attr );
				$msg = ' creado.';
			}

			//Para las relaciones HasMany y BelongsToMany...
			$model->save();
			$model = $this->saveRelationsHasMany($relations, $relationships, $model);

			$msg = str_upperspace(class_basename($model)).' '.($model->{$prefix.'ID'}).$msg;

			return response()->json([
						'status' => 'OK',
						'alerts' => $this->alerts,
						'msg' => $msg,
						'csrfToken' => csrf_token(),
					]);


		} catch(\Exception $e){
			return response()->json([
				'status' => 'ERR',
				'msg' => $e->getMessage(),
				'csrfToken' => csrf_token(),
			]);
		}
	}


	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data, $rules, $prefix)
	{
		$validator = \Validator::make($data, $rules);

		if( $validator->fails() ) 
			throw new Exception(str_replace($prefix, '', json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)));

		return $validator;
	}
	

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  string  $model
	 * @return class
	 */
	private function getModel($model, $id = 0)
	{
		if(!isset($model))
			throw new Exception('Modelo no definido');

		$model = get_model($model);
		if(!class_exists($model))
			throw new Exception('Modelo "'.basename($model).'" no existe');

		return $model;
	}
	

	/**
	 * 
	 *
	 * @param  Model  $model
	 * @return class
	 */
	private function saveRelationsHasMany($relations, $relationships, $model)
	{
		$relsHasMany = array_filter($relationships, function ($val){
							return ($val['type']!='BelongsTo');
						});

		foreach ($relations as $rel => $values) {

			if(array_key_exists($rel, $relsHasMany)){
				$arrayIds = [];

				$modelClass = get_model( $relsHasMany[$rel]['model'] );
				$modelRel = new $modelClass;
				
				if(isset($modelRel)){
					$filterKey = $modelRel::getFilterKey();

					switch ($relsHasMany[$rel]['type']) {
						case 'HasMany':
							//break;
						case 'BelongsToMany':
							foreach (explode(',', $values) as $value) {
								if($modelRel)
									$modelRel = $modelRel->where($filterKey, $value)->first();
								if($modelRel)
									$arrayIds[] = $modelRel->getKey();
								else
									$this->alerts[] = 'No existe "'.$value.'" en '.str_upperspace(class_basename($relsHasMany[$rel]['model']));
							}
							break;
					}
					$model->$rel()->sync($arrayIds, true);
				}
			}
		}
		return $model;
	}

}
