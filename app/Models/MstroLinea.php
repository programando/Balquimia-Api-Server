<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\FoldersHelper as Folders;
 
class MstroLinea extends Model
{
	protected $table = 'mstro_lineas';
	protected $primaryKey = 'id_linea';
	public $timestamps = false;

	protected $casts = [
		'orden_local' => 'int',
		'orden_web' => 'int',
		'inactivo' => 'bool'
	];

	protected $fillable = [
		'cod_linea',
		'nom_linea',
		'orden_local',
		'orden_web',
		'imagen',
		'slogan',
		'inactivo'
	];

	public function getNomLineaAttribute ( $value ) {
			return trim( $value);
	}
	public function getImagenAttribute( $value) {  
		return  Folders::LineasImages() .'/'. $value ;
	}
}
