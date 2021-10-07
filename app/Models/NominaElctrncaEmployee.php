<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class NominaElctrncaEmployee
 * 
 * @property int $id
 * @property int $id_nomina_elctrnca
 * @property int $type_worker_id
 * @property int $subtype_worker_id
 * @property bool $high_risk_pension
 * @property int $type_document_identification_id
 * @property int $identification_number
 * @property string $surname
 * @property string $second_surname
 * @property string $first_name
 * @property string $other_names
 * @property int $country_id
 * @property int $municipality_id
 * @property string $address
 * @property bool $integral_salary
 * @property float $type_contract_id
 * @property float $salary
 * @property string $worker_code
 * 
 * @property NominaElctrncaXmlSequenceNumber $nomina_elctrnca_xml_sequence_number
 *
 * @package App\Models
 */
class NominaElctrncaEmployee extends Model
{
	protected $table = 'nomina_elctrnca_employee';
	public $timestamps = false;

	protected $casts = [
		'id_nomina_elctrnca' => 'int',
		'type_worker_id' => 'int',
		'subtype_worker_id' => 'int',
		'high_risk_pension' => 'bool',
		'type_document_identification_id' => 'int',
		'identification_number' => 'int',
		'country_id' => 'int',
		'municipality_id' => 'int',
		'integral_salary' => 'bool',
		'type_contract_id' => 'float',
		'salary' => 'float'
	];

	protected $fillable = [
		'id_nomina_elctrnca',
		'type_worker_id',
		'subtype_worker_id',
		'high_risk_pension',
		'type_document_identification_id',
		'identification_number',
		'surname',
		'second_surname',
		'first_name',
		'other_names',
		'country_id',
		'municipality_id',
		'address',
		'integral_salary',
		'type_contract_id',
		'salary',
		'worker_code'
	];

	public function nomina_elctrnca_xml_sequence_number()
	{
		return $this->belongsTo(NominaElctrncaXmlSequenceNumber::class, 'id_nomina_elctrnca');
	}
}
