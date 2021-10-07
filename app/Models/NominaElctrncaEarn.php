<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class NominaElctrncaEarn
 * 
 * @property int $id
 * @property int $id_nomina_elctrnca
 * @property int $basic_worked_days
 * @property float $basic_worker_salary
 * @property float $transports_transportation_assistance
 * @property float $transports_viatic
 * @property float $transports_non_salary_viatic
 * @property string $hed_start
 * @property string $hed_end
 * @property int $hed_quantity
 * @property int $hed_type_time_id
 * @property float $hed_payment
 * @property string $hen_hours_start
 * @property string $hen_hours_end
 * @property int $hen_hours_quantity
 * @property int $hen_hours_type_time_id
 * @property float $hen_hours_payment
 * @property string $rcgo_noc_start
 * @property string $rcgo_noc_end
 * @property int $rcgo_noc_quantity
 * @property int $rcgo_noc_type_time_id
 * @property float $rcgo_noc_payment
 * @property string $heddf_start
 * @property string $heddf_end
 * @property int $heddf_quantity
 * @property int $heddf_type_time_id
 * @property float $heddf_payment
 * @property string $rcgo_heddf_start
 * @property string $rcgo_heddf_end
 * @property int $rcgo_heddf_quantity
 * @property int $rcgo_heddf_type_time_id
 * @property float $rcgo_heddf_payment
 * @property string $hendf_start
 * @property string $hendf_end
 * @property int $hendf_quantity
 * @property int $hendf_type_time_id
 * @property float $hendf_payment
 * @property string $rcgo_ndf_start
 * @property string $rcgo_ndf_end
 * @property int $rcgo_ndf_quantity
 * @property int $rcgo_ndf_type_time_id
 * @property float $rcgo_ndf_payment
 * @property string $vacation_common_start
 * @property string $vacation_common_end
 * @property int $vacation_common_quantity
 * @property float $vacation_common_payment
 * @property int $vacation_compensated_quantity
 * @property float $vacation_compensated_payment
 * @property int $primas_quantity
 * @property float $primas_payment
 * @property float $primas_non_salary_payment
 * @property float $layoffs_payment
 * @property float $layoffs_percentage
 * @property float $layoffs_interest_payment
 * @property string $incapacities_start
 * @property string $incapacities_end
 * @property int $incapacities_quantity
 * @property int $incapacities_type_incapacity_id
 * @property float $incapacities_payment
 * @property string $licensings_maternidad_start
 * @property string $licensings_maternidad_end
 * @property int $licensings_maternidad_quantity
 * @property float $licensings_maternidad_payment
 * @property string $licensings_remunerada_start
 * @property string $licensings_remunerada_end
 * @property int $licensings_remunerada_quantity
 * @property float $licensings_remunerada_payment
 * @property string $licensings_no_remunerada_start
 * @property string $licensings_no_remunerada_end
 * @property int $licensings_no_remunerada_quantity
 * @property float $bonuses_payment
 * @property float $bonuses_non_salary_payment
 * @property float $assistances_payment
 * @property float $assistances_non_salary_payment
 * @property string $other_concepts_description
 * @property float $other_concepts_payment
 * @property float $other_concepts_non_salary_payment
 * @property float $commissions_payment
 * @property float $sustainment_support
 * @property float $telecommuting
 * @property float $company_withdrawal_bonus
 * @property float $compensation
 * 
 * @property NominaElctrncaXmlSequenceNumber $nomina_elctrnca_xml_sequence_number
 *
 * @package App\Models
 */
class NominaElctrncaEarn extends Model
{
	protected $table = 'nomina_elctrnca_earn';
	public $timestamps = false;

	protected $casts = [
		'id_nomina_elctrnca' => 'int',
		'basic_worked_days' => 'int',
		'basic_worker_salary' => 'float',
		'transports_transportation_assistance' => 'float',
		'transports_viatic' => 'float',
		'transports_non_salary_viatic' => 'float',
		'hed_quantity' => 'int',
		'hed_type_time_id' => 'int',
		'hed_payment' => 'float',
		'hen_hours_quantity' => 'int',
		'hen_hours_type_time_id' => 'int',
		'hen_hours_payment' => 'float',
		'rcgo_noc_quantity' => 'int',
		'rcgo_noc_type_time_id' => 'int',
		'rcgo_noc_payment' => 'float',
		'heddf_quantity' => 'int',
		'heddf_type_time_id' => 'int',
		'heddf_payment' => 'float',
		'rcgo_heddf_quantity' => 'int',
		'rcgo_heddf_type_time_id' => 'int',
		'rcgo_heddf_payment' => 'float',
		'hendf_quantity' => 'int',
		'hendf_type_time_id' => 'int',
		'hendf_payment' => 'float',
		'rcgo_ndf_quantity' => 'int',
		'rcgo_ndf_type_time_id' => 'int',
		'rcgo_ndf_payment' => 'float',
		'vacation_common_quantity' => 'int',
		'vacation_common_payment' => 'float',
		'vacation_compensated_quantity' => 'int',
		'vacation_compensated_payment' => 'float',
		'primas_quantity' => 'int',
		'primas_payment' => 'float',
		'primas_non_salary_payment' => 'float',
		'layoffs_payment' => 'float',
		'layoffs_percentage' => 'float',
		'layoffs_interest_payment' => 'float',
		'incapacities_quantity' => 'int',
		'incapacities_type_incapacity_id' => 'int',
		'incapacities_payment' => 'float',
		'licensings_maternidad_quantity' => 'int',
		'licensings_maternidad_payment' => 'float',
		'licensings_remunerada_quantity' => 'int',
		'licensings_remunerada_payment' => 'float',
		'licensings_no_remunerada_quantity' => 'int',
		'bonuses_payment' => 'float',
		'bonuses_non_salary_payment' => 'float',
		'assistances_payment' => 'float',
		'assistances_non_salary_payment' => 'float',
		'other_concepts_payment' => 'float',
		'other_concepts_non_salary_payment' => 'float',
		'commissions_payment' => 'float',
		'sustainment_support' => 'float',
		'telecommuting' => 'float',
		'company_withdrawal_bonus' => 'float',
		'compensation' => 'float'
	];

	protected $fillable = [
		'id_nomina_elctrnca',
		'basic_worked_days',
		'basic_worker_salary',
		'transports_transportation_assistance',
		'transports_viatic',
		'transports_non_salary_viatic',
		'hed_start',
		'hed_end',
		'hed_quantity',
		'hed_type_time_id',
		'hed_payment',
		'hen_hours_start',
		'hen_hours_end',
		'hen_hours_quantity',
		'hen_hours_type_time_id',
		'hen_hours_payment',
		'rcgo_noc_start',
		'rcgo_noc_end',
		'rcgo_noc_quantity',
		'rcgo_noc_type_time_id',
		'rcgo_noc_payment',
		'heddf_start',
		'heddf_end',
		'heddf_quantity',
		'heddf_type_time_id',
		'heddf_payment',
		'rcgo_heddf_start',
		'rcgo_heddf_end',
		'rcgo_heddf_quantity',
		'rcgo_heddf_type_time_id',
		'rcgo_heddf_payment',
		'hendf_start',
		'hendf_end',
		'hendf_quantity',
		'hendf_type_time_id',
		'hendf_payment',
		'rcgo_ndf_start',
		'rcgo_ndf_end',
		'rcgo_ndf_quantity',
		'rcgo_ndf_type_time_id',
		'rcgo_ndf_payment',
		'vacation_common_start',
		'vacation_common_end',
		'vacation_common_quantity',
		'vacation_common_payment',
		'vacation_compensated_quantity',
		'vacation_compensated_payment',
		'primas_quantity',
		'primas_payment',
		'primas_non_salary_payment',
		'layoffs_payment',
		'layoffs_percentage',
		'layoffs_interest_payment',
		'incapacities_start',
		'incapacities_end',
		'incapacities_quantity',
		'incapacities_type_incapacity_id',
		'incapacities_payment',
		'licensings_maternidad_start',
		'licensings_maternidad_end',
		'licensings_maternidad_quantity',
		'licensings_maternidad_payment',
		'licensings_remunerada_start',
		'licensings_remunerada_end',
		'licensings_remunerada_quantity',
		'licensings_remunerada_payment',
		'licensings_no_remunerada_start',
		'licensings_no_remunerada_end',
		'licensings_no_remunerada_quantity',
		'bonuses_payment',
		'bonuses_non_salary_payment',
		'assistances_payment',
		'assistances_non_salary_payment',
		'other_concepts_description',
		'other_concepts_payment',
		'other_concepts_non_salary_payment',
		'commissions_payment',
		'sustainment_support',
		'telecommuting',
		'company_withdrawal_bonus',
		'compensation'
	];

	public function nomina_elctrnca_xml_sequence_number()
	{
		return $this->belongsTo(NominaElctrncaXmlSequenceNumber::class, 'id_nomina_elctrnca');
	}
}
