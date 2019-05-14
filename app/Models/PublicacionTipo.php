<?php
namespace App\Models;

use App\Models\ModelWithSoftDeletes;

class PublicacionTipo extends ModelWithSoftDeletes
{
	
	//Nombre de la tabla en la base de datos
	protected $table = 'PUBLICACIONES_TIPOS';
	protected $primaryKey = 'PUTI_ID';
	protected $filterKey = 'PUTI_NOMBRE';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'PUTI_FECHACREADO';
	const UPDATED_AT = 'PUTI_FECHAMODIFICADO';
	const DELETED_AT = 'PUTI_FECHAELIMINADO';
	protected $dates = ['PUTI_FECHACREADO', 'PUTI_FECHAMODIFICADO', 'PUTI_FECHAELIMINADO'];

	protected $fillable = [
		'PUTI_NOMBRE',
	];

	public static function rules($id = 0){
		return $rules = [
			'PUTI_NOMBRE' => ['required','max:50',static::uniqueWith($id, ['PUTI_NOMBRE'])],
		];
	}

	public function publicaciones()
	{
		$foreingKey = 'PUTI_ID';
		return $this->hasMany(Publicacion::class, $foreingKey);
	}

}
