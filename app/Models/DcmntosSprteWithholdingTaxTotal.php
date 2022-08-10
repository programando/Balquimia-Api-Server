<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DcmntosSprteWithholdingTaxTotal
 * 
 * @property int $idregistro
 * @property int|null $id_fact_elctrnca
 * @property float|null $tax_id
 * @property float|null $percent
 * @property float|null $tax_amount
 * @property float|null $taxable_amount
 * 
 * @property FctrasElctrnca|null $fctras_elctrnca
 *
 * @package App\Models
 */
class DcmntosSprteWithholdingTaxTotal extends Model
{
	protected $table = 'dcmntos_sprte_withholding_tax_totals';
	protected $primaryKey = 'idregistro';
	public $timestamps = false;

	protected $casts = [
		'id_fact_elctrnca' => 'int',
		'tax_id' => 'float',
		'percent' => 'float',
		'tax_amount' => 'float',
		'taxable_amount' => 'float'
	];

	protected $fillable = [
		'id_fact_elctrnca',
		'tax_id',
		'percent',
		'tax_amount',
		'taxable_amount'
	];

	public function fctras_elctrnca()
	{
		return $this->belongsTo(FctrasElctrnca::class, 'id_fact_elctrnca');
	}
}
