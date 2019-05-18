<?php
namespace App\Models;

use App\Models\ModelWithSoftDeletes;

class Publicacion extends ModelWithSoftDeletes
{
	
	//Nombre de la tabla en la base de datos
	protected $table = 'PUBLICACIONES';
	protected $primaryKey = 'PUBL_ID';
	protected $filterKey = 'PUBL_NUMEROIDENTIFICACION';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'PUBL_FECHACREADO';
	const UPDATED_AT = 'PUBL_FECHAMODIFICADO';
	const DELETED_AT = 'PUBL_FECHAELIMINADO';
	protected $dates = ['PUBL_FECHACREADO', 'PUBL_FECHAMODIFICADO', 'PUBL_FECHAELIMINADO'];

	protected $fillable = [
		'PUBL_TITULO',
		'PUBL_DESCRIPCION',
		'PUBL_LATITUD',
		'PUBL_LONGITUD',
		'PUES_ID',
		'PUTI_ID',
		'PERS_ID',
		'MASC_ID',
		'BARR_ID',
	];

	public static function rules($id = 0){
		return $rules = [
			'PUBL_TITULO'      => ['required','max:50'],
			'PUBL_DESCRIPCION' => ['required','max:300'],
			'PUBL_LATITUD'     => ['required','numeric','between:-90,90'],
			'PUBL_LONGITUD'    => ['required','numeric','between:-180,180'],
			'PUES_ID'          => ['required','numeric'],
			'PUTI_ID'          => ['required','numeric'],
			'PERS_ID'          => ['required','numeric'],
			'MASC_ID'          => ['required','numeric'],
			'BARR_ID'          => ['required','numeric'],
		];
	}

	public function publicacionEstado()
	{
		return $this->belongsTo(PublicacionEstado::class, 'PUES_ID');
	}

	public function publicacionTipo()
	{
		return $this->belongsTo(PublicacionTipo::class, 'PUTI_ID');
	}

	public function persona()
	{
		return $this->belongsTo(Persona::class, 'PERS_ID');
	}

	public function mascota()
	{
		return $this->belongsTo(Mascota::class, 'MASC_ID');
	}

	public function barrio()
	{
		return $this->belongsTo(Barrio::class, 'BARR_ID');
	}

}
