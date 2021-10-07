<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class NominaElctrncaPayment
 * 
 * @property int $id
 * @property int $id_nomina_elctrnca
 * @property int $payment_form_id
 * @property int $payment_method_id
 * @property string $bank
 * @property string $account_type
 * @property string $account_number
 * 
 * @property NominaElctrncaXmlSequenceNumber $nomina_elctrnca_xml_sequence_number
 *
 * @package App\Models
 */
class NominaElctrncaPayment extends Model
{
	protected $table = 'nomina_elctrnca_payment';
	public $timestamps = false;

	protected $casts = [
		'id_nomina_elctrnca' => 'int',
		'payment_form_id' => 'int',
		'payment_method_id' => 'int'
	];

	protected $fillable = [
		'id_nomina_elctrnca',
		'payment_form_id',
		'payment_method_id',
		'bank',
		'account_type',
		'account_number'
	];

	public function nomina_elctrnca_xml_sequence_number()
	{
		return $this->belongsTo(NominaElctrncaXmlSequenceNumber::class, 'id_nomina_elctrnca');
	}
}
