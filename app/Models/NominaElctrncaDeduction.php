<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class NominaElctrncaDeduction
 * 
 * @property int $id
 * @property int $id_nomina_elctrnca
 * @property float $health_percentage
 * @property float $health_payment
 * @property float $pension_fund_percentage
 * @property float $pension_payment
 * @property string $libranzas_description
 * @property float $libranzas_payment
 * @property float $other_deductions_payment
 * @property float $voluntary_pension
 * @property float $debt
 * 
 * @property NominaElctrncaXmlSequenceNumber $nomina_elctrnca_xml_sequence_number
 *
 * @package App\Models
 */
class NominaElctrncaDeduction extends Model
{
	protected $table = 'nomina_elctrnca_deduction';
	public $timestamps = false;

	protected $casts = [
		'id_nomina_elctrnca' => 'int',
		'health_percentage' => 'float',
		'health_payment' => 'float',
		'pension_fund_percentage' => 'float',
		'pension_payment' => 'float',
		'libranzas_payment' => 'float',
		'other_deductions_payment' => 'float',
		'voluntary_pension' => 'float',
		'debt' => 'float'
	];

	protected $fillable = [
		'id_nomina_elctrnca',
		'health_percentage',
		'health_payment',
		'pension_fund_percentage',
		'pension_payment',
		'libranzas_description',
		'libranzas_payment',
		'other_deductions_payment',
		'voluntary_pension',
		'debt'
	];

	public function nomina_elctrnca_xml_sequence_number()
	{
		return $this->belongsTo(NominaElctrncaXmlSequenceNumber::class, 'id_nomina_elctrnca');
	}
}
