<?php
namespace App\Models;

use App\Models\ModelWithSoftDeletes;

class Mascota extends ModelWithSoftDeletes
{
	
	//Nombre de la tabla en la base de datos
	protected $table = 'MASCOTAS';
	protected $primaryKey = 'MASC_ID';
	protected $filterKey = 'MASC_NOMBRE';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'MASC_FECHACREADO';
	const UPDATED_AT = 'MASC_FECHAMODIFICADO';
	const DELETED_AT = 'MASC_FECHAELIMINADO';
	protected $dates = ['MASC_FECHACREADO', 'MASC_FECHAMODIFICADO', 'MASC_FECHAELIMINADO'];

	protected $fillable = [
		'MASC_NOMBRE',
		'MASC_EDAD',
		'PERS_ID',
	];

	public static function rules($id = 0){
		return $rules = [
			'MASC_NOMBRE' => ['required','max:50'],
			'MASC_EDAD'   => ['numeric','between:0,255'],
		];
	}

	public function persona()
	{
		$foreingKey = 'PERS_ID';
		return $this->belongsTo(Persona::class, $foreingKey);
	}

}