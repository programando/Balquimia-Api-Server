<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FctrasElctrncasSoportDocumentResponse
 * 
 * @property int $id
 * @property int|null $id_fact_elctrnca
 * @property string|null $cod_event
 * @property string|null $qr_data
 * @property string|null $application_response_base64_bytes
 * @property string|null $attached_document_base64_bytes
 * @property string|null $pdf_base64_bytes
 * @property string|null $zip_base64_bytes
 * @property string|null $dian_response_base64_bytes
 * 
 * @property FctrasElctrnca|null $fctras_elctrnca
 *
 * @package App\Models
 */
class FctrasElctrncasSoportDocumentResponse extends Model
{
	protected $table = 'fctras_elctrncas_soport_document_response';
	public $timestamps = false;

	protected $casts = [
		'id_fact_elctrnca' => 'int'
	];

	protected $fillable = [
		'id_fact_elctrnca',
		'cod_event',
		'qr_data',
		'application_response_base64_bytes',
		'attached_document_base64_bytes',
		'pdf_base64_bytes',
		'zip_base64_bytes',
		'dian_response_base64_bytes'
	];

	public function fctras_elctrnca()
	{
		return $this->belongsTo(FctrasElctrnca::class, 'id_fact_elctrnca');
	}
}
