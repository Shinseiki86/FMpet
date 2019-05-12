<?php

namespace App\Models;

use App\Models\ModelWithSoftDeletes;

class Barrio extends ModelWithSoftDeletes
{
	
	//Nombre de la tabla en la base de datos
	protected $table = 'BARRIOS';
	protected $primaryKey = 'BARR_ID';
	protected $filterKey = 'BARR_NOMBRE';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'BARR_FECHACREADO';
	const UPDATED_AT = 'BARR_FECHAMODIFICADO';
	const DELETED_AT = 'BARR_FECHAELIMINADO';
	protected $dates = ['BARR_FECHACREADO', 'BARR_FECHAMODIFICADO', 'BARR_FECHAELIMINADO'];

	protected $fillable = [
		'BARR_CODIGO',
		'BARR_NOMBRE',
		'BARR_ESTRATO',
		'CIUD_ID',
	];

	public static function rules($id = 0){
		$rules = [
			'BARR_CODIGO' => ['required','numeric'],
			'BARR_NOMBRE' => ['required','max:300',static::uniqueWith($id, ['BARR_CODIGO'])],
			'CIUD_ID'     => ['required','numeric']
		];
		return $rules;
	}

	public function ciudad()
	{
		$foreingKey = 'CIUD_ID';
		return $this->belongsTo(Ciudad::class, $foreingKey);
	}

}
