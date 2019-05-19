<?php
namespace App\Models;

use App\Models\ModelWithSoftDeletes;

class Comentario extends ModelWithSoftDeletes
{
	
	//Nombre de la tabla en la base de datos
	protected $table = 'COMENTARIOS';
	protected $primaryKey = 'COME_ID';
	protected $filterKey = 'COME_NUMEROIDENTIFICACION';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'COME_FECHACREADO';
	const UPDATED_AT = 'COME_FECHAMODIFICADO';
	const DELETED_AT = 'COME_FECHAELIMINADO';
	protected $dates = ['COME_FECHACREADO', 'COME_FECHAMODIFICADO', 'COME_FECHAELIMINADO'];

	protected $fillable = [
		'COME_DESCRIPCION',
		'PUBL_ID',
	];

	public static function rules($id = 0){
		return $rules = [
			'COME_DESCRIPCION' => ['required','max:300'],
			'PUBL_ID'          => ['required','numeric'],
		];
	}

	public function publicacion()
	{
		return $this->belongsTo(Publicacion::class, 'PUBL_ID');
	}


}
