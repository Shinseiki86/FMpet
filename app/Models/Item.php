<?php
namespace App\Models;

use App\Models\ModelWithSoftDeletes;

class Item extends ModelWithSoftDeletes
{
	
	//Nombre de la tabla en la base de datos
	protected $table = 'ITEMS_PUBLICACIONES_COMENTARIOS';
	protected $primaryKey = 'ITEM_ID';
	protected $filterKey = 'ITEM_NUMEROIDENTIFICACION';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'ITEM_FECHACREADO';
	const UPDATED_AT = 'ITEM_FECHAMODIFICADO';
	const DELETED_AT = 'ITEM_FECHAELIMINADO';
	protected $dates = ['ITEM_FECHACREADO', 'ITEM_FECHAMODIFICADO', 'ITEM_FECHAELIMINADO'];

	protected $fillable = [
		'ITEM_TITULO',
		'ITEM_DESCRIPCION',
		'ITEM_LATITUD',
		'ITEM_LONGITUD',
		'PUES_ID',
		'PUTI_ID',
		'PERS_ID',
		'MASC_ID',
		'BARR_ID',
	];

	public static function rules($id = 0){
		return $rules = [
			'ITEM_TITULO'      => ['required','max:50'],
			'ITEM_DESCRIPCION' => ['required','max:300'],
			'ITEM_LATITUD'     => ['required','numeric','between:-90,90'],
			'ITEM_LONGITUD'    => ['required','numeric','between:-180,180'],
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

	public function comentarios()
	{
		return $this->hasMany(Comentario::class, 'ITEM_ID');
	}

}
