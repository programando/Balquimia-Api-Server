<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

use DB;
 
class MstroClasesPrdcto extends Model
{
	protected $table = 'mstro_clases_prdcto';
	protected $primaryKey = 'id_clse_prdcto';
	public $timestamps = false;

	protected $casts = [
		'inactivo' => 'bool'
	];

	protected $fillable = [
		'nom_clse_prdcto',
		'inactivo'
	];

 public static function getClasesPorLinea ( $IdLinea ) {
	 	return     DB::select(' call productos_clases_por_linea ( ?)', array($IdLinea));
 }


public function getNomClsePrdctoAttribute( $value ) {
	 return trim ( $value );
}



	public function prdctos()	{
		return $this->hasMany(Prdcto::class, 'id_clse_prdcto');
	}
}
