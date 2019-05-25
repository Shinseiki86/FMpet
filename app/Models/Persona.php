<?php
namespace App\Models;

use App\Models\ModelWithSoftDeletes;

class Persona extends ModelWithSoftDeletes
{
	
	//Nombre de la tabla en la base de datos
	protected $table = 'PERSONAS';
	protected $primaryKey = 'PERS_ID';
	protected $filterKey = 'PERS_NUMEROIDENTIFICACION';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'PERS_FECHACREADO';
	const UPDATED_AT = 'PERS_FECHAMODIFICADO';
	const DELETED_AT = 'PERS_FECHAELIMINADO';
	protected $dates = ['PERS_FECHACREADO', 'PERS_FECHAMODIFICADO', 'PERS_FECHAELIMINADO'];

	//protected $appends = ['nombre_completo',];

	protected $fillable = [
		'PERS_NUMEROIDENTIFICACION',
		'PERS_NOMBRE',
		'PERS_APELLIDO',
		'PERS_TELEFONO',
		'PERS_DIRECCION',
		'PERS_CORREO',
		'PETI_ID',
		'USER_ID',
	];

	public static function rules($id = 0){
		return $rules = [
			'PERS_NUMEROIDENTIFICACION' => ['required','numeric','between:1,999999999999999',static::uniqueWith($id, ['PERS_CODIGO'])],
			'PERS_NOMBRE'               => ['required','max:50'],
			'PERS_APELLIDO'             => ['required','max:50'],
			'PERS_TELEFONO'             => ['numeric','between:100000,999999999999999'],
			'PERS_DIRECCION'            => ['string','max:100'],
			'PERS_CORREO'               => ['email','max:320'],
		];
	}

	public function user()
	{
		return $this->hasOne(User::class, 'id');
	}

	public function personaTipo()
	{
		return $this->belongsTo(PersonaTipo::class, 'PETI_ID');
	}

	public function mascotas()
	{
		return $this->hasMany(Mascota::class, 'PERS_ID');
	}


	/**
	 * Retorna el nombre completo de la persona.
	 *
	 * @return string
	 /
	public function getNombreCompletoAttribute()
	{
    	return "{$this->PERS_NOMBRE} {$this->PERS_APELLIDO}";
	}*/

}
