<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class NominaElctrncaGeneralInformation
 * 
 * @property int $id
 * @property int $id_nomina_elctrnca
 * @property string $date
 * @property string $time
 * @property int $payroll_period_id
 * @property int $trm
 * @property Carbon $fcha_sys
 * 
 * @property NominaElctrncaXmlSequenceNumber $nomina_elctrnca_xml_sequence_number
 *
 * @package App\Models
 */
class NominaElctrncaGeneralInformation extends Model
{
	protected $table = 'nomina_elctrnca_general_information';
	public $timestamps = false;

	protected $casts = [
		'id_nomina_elctrnca' => 'int',
		'payroll_period_id' => 'int',
		'trm' => 'int'
	];

	protected $dates = [
		'fcha_sys'
	];

	protected $fillable = [
		'id_nomina_elctrnca',
		'date',
		'time',
		'payroll_period_id',
		'trm',
		'fcha_sys'
	];

	public function nomina_elctrnca_xml_sequence_number()
	{
		return $this->belongsTo(NominaElctrncaXmlSequenceNumber::class, 'id_nomina_elctrnca');
	}
}
