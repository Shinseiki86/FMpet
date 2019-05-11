<?php

namespace App\Models;

use App\Models\ModelWithSoftDeletes;

class Pais extends ModelWithSoftDeletes
{

	//Nombre de la tabla en la base de datos
	protected $table = 'PAISES';
    protected $primaryKey = 'PAIS_ID';
	protected $filterKey  = 'PAIS_NOMBRE';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'PAIS_FECHACREADO';
	const UPDATED_AT = 'PAIS_FECHAMODIFICADO';
	const DELETED_AT = 'PAIS_FECHAELIMINADO';
	protected $dates = ['PAIS_FECHACREADO', 'PAIS_FECHAMODIFICADO', 'PAIS_FECHAELIMINADO'];

	protected $appends = ['count_departamentos',];

	protected $fillable = [
		'PAIS_CODIGO',
		'PAIS_NOMBRE',
	];

	public static function rules($id = 0){
		$rules = [
			'PAIS_CODIGO' => ['required','numeric',static::unique($id,'PAIS_CODIGO')],
			'PAIS_NOMBRE' => ['required','max:300',static::unique($id,'PAIS_NOMBRE')],
		];
		return $rules;
	}
	
	public function departamentos()
	{
		$foreingKey = 'PAIS_ID';
		return $this->hasMany(Departamento::class, $foreingKey);
	}

	/**
	 * Retorna el total de respuestas que han realizado a la encuesta.
	 *
	 * @param  void
	 * @return integer
	 */
	public function getCountDepartamentosAttribute()
	{
		return $this->departamentos->count();
	}
}
