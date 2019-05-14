<?php
namespace App\Models;

use App\Models\ModelWithSoftDeletes;

class PersonaTipo extends ModelWithSoftDeletes
{
	
	//Nombre de la tabla en la base de datos
	protected $table = 'PERSONAS_TIPOS';
	protected $primaryKey = 'PETI_ID';
	protected $filterKey = 'PETI_NOMBRE';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'PETI_FECHACREADO';
	const UPDATED_AT = 'PETI_FECHAMODIFICADO';
	const DELETED_AT = 'PETI_FECHAELIMINADO';
	protected $dates = ['PETI_FECHACREADO', 'PETI_FECHAMODIFICADO', 'PETI_FECHAELIMINADO'];

	protected $fillable = [
		'PETI_NOMBRE',
	];

	public static function rules($id = 0){
		return $rules = [
			'PETI_NOMBRE' => ['required','max:50',static::uniqueWith($id, ['PETI_NOMBRE'])],
		];
	}

	public function personas()
	{
		$foreingKey = 'PETI_ID';
		return $this->hasMany(Persona::class, $foreingKey);
	}

}
