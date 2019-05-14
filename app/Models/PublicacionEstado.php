<?php
namespace App\Models;

use App\Models\ModelWithSoftDeletes;

class PublicacionEstado extends ModelWithSoftDeletes
{
	
	//Nombre de la tabla en la base de datos
	protected $table = 'PUBLICACIONES_ESTADOS';
	protected $primaryKey = 'PUES_ID';
	protected $filterKey = 'PUES_NOMBRE';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'PUES_FECHACREADO';
	const UPDATED_AT = 'PUES_FECHAMODIFICADO';
	const DELETED_AT = 'PUES_FECHAELIMINADO';
	protected $dates = ['PUES_FECHACREADO', 'PUES_FECHAMODIFICADO', 'PUES_FECHAELIMINADO'];

	protected $fillable = [
		'PUES_NOMBRE',
	];

	public static function rules($id = 0){
		return $rules = [
			'PUES_NOMBRE' => ['required','max:50',static::uniqueWith($id, ['PUES_NOMBRE'])],
		];
	}

	public function publicaciones()
	{
		$foreingKey = 'PUES_ID';
		return $this->hasMany(Publicacion::class, $foreingKey);
	}

}
