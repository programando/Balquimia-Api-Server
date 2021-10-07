<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class NominaElctrncaEmployer
 * 
 * @property int $id
 * @property int $id_nomina_elctrnca
 * @property string $name
 * @property string $surname
 * @property string $second_surname
 * @property string $first_name
 * @property string $other_names
 * @property int $type_document_identification_id
 * @property int $identification_number
 * @property int $country_id
 * @property int $municipality_id
 * @property string $address
 * 
 * @property NominaElctrncaXmlSequenceNumber $nomina_elctrnca_xml_sequence_number
 *
 * @package App\Models
 */
class NominaElctrncaEmployer extends Model
{
	protected $table = 'nomina_elctrnca_employer';
	public $timestamps = false;

	protected $casts = [
		'id_nomina_elctrnca' => 'int',
		'type_document_identification_id' => 'int',
		'identification_number' => 'int',
		'country_id' => 'int',
		'municipality_id' => 'int'
	];

	protected $fillable = [
		'id_nomina_elctrnca',
		'name',
		'surname',
		'second_surname',
		'first_name',
		'other_names',
		'type_document_identification_id',
		'identification_number',
		'country_id',
		'municipality_id',
		'address'
	];

	public function nomina_elctrnca_xml_sequence_number()
	{
		return $this->belongsTo(NominaElctrncaXmlSequenceNumber::class, 'id_nomina_elctrnca');
	}
}
