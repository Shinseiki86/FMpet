<?php
namespace App\Models;

use App\Models\ModelWithSoftDeletes;

class Adjunto extends ModelWithSoftDeletes
{
	
	//Nombre de la tabla en la base de datos
	protected $table = 'ADJUNTOS';
	protected $primaryKey = 'ADJU_ID';
	protected $filterKey = 'ADJU_PATH';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'ADJU_FECHACREADO';
	const UPDATED_AT = 'ADJU_FECHAMODIFICADO';
	const DELETED_AT = 'ADJU_FECHAELIMINADO';
	protected $dates = ['ADJU_FECHACREADO', 'ADJU_FECHAMODIFICADO', 'ADJU_FECHAELIMINADO'];

	protected $appends = ['url',];

	protected $fillable = [
		'ADJU_PATH',
		'PUBL_ID',
		'COME_ID',
	];

	public static function rules($id = 0){
		return $rules = [
			'ADJU_PATH' => ['required','max:255'],
		];
	}

	public function publicacion()
	{
		return $this->belongsTo(Publicacion::class, 'PUBL_ID');
	}

	public function comentario()
	{
		return $this->belongsTo(Publicacion::class, 'COME_ID');
	}

	/**
	 * Retorna el nombre completo de la persona.
	 *
	 * @return string
	 */
	public function getUrlAttribute()
	{
    	return asset('adjuntos/'.$this->PUBL_ID.'/'.$this->ADJU_PATH);
	}

}
