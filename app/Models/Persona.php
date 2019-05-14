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

	protected $fillable = [
		'PERS_NUMEROIDENTIFICACION',
		'PERS_NOMBRE',
		'PERS_APELLIDO',
		'PERS_TELEFONO',
		'PERS_DIRECCION',
		'PERS_CORREO',
	];

	public static function rules($id = 0){
		return $rules = [
			'PERS_CODIGO'   => ['required','numeric','digits:15',static::uniqueWith($id, ['PERS_CODIGO'])],
			'PERS_NOMBRE'   => ['required','max:50'],
			'PERS_APELLIDO' => ['required','max:50'],
			'PERS_TELEFONO' => ['numeric','digits:15'],
			'PERS_DIRECCION'=> ['string','max:20'],
			'PERS_CORREO'   => ['email','max:320'],
		];
	}

	public function personaTipo()
	{
		$foreingKey = 'PETI_ID';
		return $this->belongsTo(PersonaTipo::class, $foreingKey);
	}

	public function mascotas()
	{
		$foreingKey = 'PERS_ID';
		return $this->hasMany(Mascota::class, $foreingKey);
	}

}
