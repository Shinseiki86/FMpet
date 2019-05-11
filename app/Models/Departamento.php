<?php

namespace App\Models;

use App\Models\ModelWithSoftDeletes;

class Departamento extends ModelWithSoftDeletes
{

	//Nombre de la tabla en la base de datos
	protected $table = 'DEPARTAMENTOS';
    protected $primaryKey = 'DEPA_ID';
	protected $filterKey  = 'DEPA_NOMBRE';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'DEPA_FECHACREADO';
	const UPDATED_AT = 'DEPA_FECHAMODIFICADO';
	const DELETED_AT = 'DEPA_FECHAELIMINADO';
	protected $dates = ['DEPA_FECHACREADO', 'DEPA_FECHAMODIFICADO', 'DEPA_FECHAELIMINADO'];

	protected $appends = ['count_ciudades',];

	protected $fillable = [
		'DEPA_CODIGO',
		'DEPA_NOMBRE',
		'PAIS_ID',
	];

	public static function rules($id = 0){
		$rules = [
			'DEPA_CODIGO' => ['required','numeric',static::unique($id,'DEPA_CODIGO')],
			'DEPA_NOMBRE' => ['required','max:300',static::unique($id,'DEPA_NOMBRE')],
			'PAIS_ID'     => ['required','numeric']//, 'exists:PAISES'],
		];
		return $rules;
	}

	public function ciudades()
	{
		$foreingKey = 'DEPA_ID';
		return $this->hasMany(Ciudad::class, $foreingKey);
	}

	public function pais()
	{
		$foreingKey = 'PAIS_ID';
		return $this->belongsTo(Pais::class, $foreingKey);
	}


	/**
	 * Retorna el total de respuestas que han realizado a la encuesta.
	 *
	 * @param  void
	 * @return integer
	 */
	public function getCountCiudadesAttribute()
	{
		return $this->ciudades->count();
	}
}
