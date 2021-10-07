<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class NominaElctrncaPeriod
 * 
 * @property int $id
 * @property int $id_nomina_elctrnca
 * @property string $admission_date
 * @property string $withdrawal_date
 * @property string $settlement_start_date
 * @property string $settlement_end_date
 * @property int $amount_time
 * @property string $date_issue
 * 
 * @property NominaElctrncaXmlSequenceNumber $nomina_elctrnca_xml_sequence_number
 *
 * @package App\Models
 */
class NominaElctrncaPeriod extends Model
{
	protected $table = 'nomina_elctrnca_period';
	public $timestamps = false;

	protected $casts = [
		'id_nomina_elctrnca' => 'int',
		'amount_time' => 'int'
	];

	protected $fillable = [
		'id_nomina_elctrnca',
		'admission_date',
		'withdrawal_date',
		'settlement_start_date',
		'settlement_end_date',
		'amount_time',
		'date_issue'
	];

	public function nomina_elctrnca_xml_sequence_number()
	{
		return $this->belongsTo(NominaElctrncaXmlSequenceNumber::class, 'id_nomina_elctrnca');
	}
}
