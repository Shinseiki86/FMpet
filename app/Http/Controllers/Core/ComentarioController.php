<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use DataTables;

use App\Models\Comentario;
use App\Models\Publicacion;
use App\Models\Adjunto;

class ComentarioController extends Controller
{
	protected $route = 'Core.publicaciones';
	protected $class = Comentario::class;

	public function __construct()
	{
		parent::__construct();
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
	 * Actualiza un registro en la base de datos.
	 *
	 * @param  int  $COME_ID
	 * @return Response
	 */
	public function update($COME_ID)
	{
		return parent::updateModel($COME_ID);
	}


	/**
	 * {@inheritDoc}
	 *
	protected function postCreateOrUpdate($model)
	{
		$files = request()->file('arrAdjuntos');
		if(count($files) > 0){
			foreach ($files as $file) {
			    $extension = $file->getClientOriginalExtension();
			    $adj = Adjunto::create(['ADJU_PATH'=>'in proccess','COME_ID'=>$model->COME_ID]);
				$path = public_path('adjuntos/'.$model->PUBL_ID);
				$filename = 'Adj_'.$adj->ADJU_ID.'.'.$file->getClientOriginalExtension();
				$file->move($path, $filename);
			    $adj->update(['ADJU_PATH'=>$filename]);
			}
		}
		$model->load('adjuntos');
		return $model;
	}*/


	/**
	 * Elimina un registro de la base de datos.
	 *
	 * @param  int  $COME_ID
	 * @return Response
	 */
	public function destroy($COME_ID)
	{
		return parent::destroyModel($COME_ID);
	}




}

