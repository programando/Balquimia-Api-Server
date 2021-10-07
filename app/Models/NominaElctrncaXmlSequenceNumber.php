<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

 
class NominaElctrncaXmlSequenceNumber extends Model
{
	protected $table = 'nomina_elctrnca_xml_sequence_number';
	protected $primaryKey = 'id_nomina_elctrnca';
	public $timestamps = false;

	protected $casts = [
		'number' => 'int',
		'rounding' => 'bool',
		'accrued_total' => 'float',
		'deductions_total' => 'float',
		'total' => 'float'
	];

	protected $fillable = [
		'worker_code',
		'prefix',
		'number',
		'rounding',
		'accrued_total',
		'deductions_total',
		'total'
	];


		public static function scopedianReporting ( $query ){
				return $query->Where('rpte_dian','0')->get();	
			}


	public function generalInformation()	{
		return $this->hasMany(NominaElctrncaGeneralInformation::class, 'id_nomina_elctrnca');
	}

	public function employer()	{
		return $this->hasMany(NominaElctrncaEmployer::class, 'id_nomina_elctrnca');
	}

	public function employee()	{
		return $this->hasMany(NominaElctrncaEmployee::class, 'id_nomina_elctrnca');
	}

	public function period()	{
		return $this->hasMany(NominaElctrncaPeriod::class, 'id_nomina_elctrnca');
	}

		public function payment()	{
		return $this->hasMany(NominaElctrncaPayment::class, 'id_nomina_elctrnca');
	}
	
	public function earns()	{
		return $this->hasMany(NominaElctrncaEarn::class, 'id_nomina_elctrnca');
	}

	public function deductions()	{
		return $this->hasMany(NominaElctrncaDeduction::class, 'id_nomina_elctrnca');
	}









	
}
