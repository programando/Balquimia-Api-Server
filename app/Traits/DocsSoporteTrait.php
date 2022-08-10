<?php

namespace App\Traits;
 
use Illuminate\Support\Str;
use App\Models\FctrasElctrnca;
use App\Models\FctrasElctrncasDataResponse;
use App\Models\FctrasElctrncasSoportDocumentResponse as DocSoporteResponse;

use Illuminate\Support\Facades\Hash;
use App\Helpers\DatesHelper as Fecha;
use App\Helpers\NumbersHelper as Numbers;
use App\Helpers\StringsHelper as Strings;



trait DocsSoporteTrait {
    
    protected $PdfFile, $XmlFile, $DocumentNumber;
    
    

    protected function DocSoporteHeaderTrait($Document , &$jsonObject, $FechaTransacion  ) {      
        $jsonObject= [
            'number'            => $Document["number"],
            'type_document_id'  => $Document["type_document_id"],
            'type_operation_id' => $Document["type_operation_id"],
            // 'resolution_id'    => 11,
            'sync'              => true,
            'date'              => Fecha::YMD( $FechaTransacion) 
            ] ;
        }

    protected function DocSoporteEnvironmentTrait ( &$jsonObject ) {
        $jsonObject['environment']=[
                'type_environment_id' => '2',                                      // 1 producction,   2 habilitacion o pruebas
        ]; 
    }

    protected function DocSoporteResolutionTrait ( &$jsonObject ) {
         
        $jsonObject['resolution']=[
                'prefix'          => 'SETP',                                   
                'resolution'      => '18760000001',                            
                'resolution_date' => '0001-01-01',                               
                'technical_key'   => 'fc8eac422eba16e22ffd8c6f94b3f40a6e38162c',   
                'from'            => '990000000',                              
                'to'              => '995000000',                              
                'date_from'       => '2019-01-19',                               
                'date_to'         => '2030-01-19',                               
        ]; 
    }


    protected function DocSoporteWithHoldingTaxTotalsTrait( $Retenciones, &$jsonObject, $jsonKey  ) {
        
        if (  $Retenciones->count() === 0 )  return ;

        $WithHoldingTaxTotals    = [];
        $WithHoldingTaxTotalLine = [];
        foreach ($Retenciones as $Retencion) {
           $WithHoldingTaxTotalLine = [
             'tax_id'         => $Retencion['tax_id'],
             'percent'        => Numbers::jsonFormat ( $Retencion['percent'], 2),
             'tax_amount'     => Numbers::jsonFormat ( $Retencion['tax_amount'], 2),
             'taxable_amount' => Numbers::jsonFormat ( $Retencion['taxable_amount'], 2),  
           ];  
            $WithHoldingTaxTotals[] = $WithHoldingTaxTotalLine ;
        }
        $jsonObject [$jsonKey] = $WithHoldingTaxTotals;
    }

    protected function DocSoporteLegalMonetaryTotalsTrait ( $Totals, &$jsonObject, $key  ) {
        $jsonObject[$key] =[
            'line_extension_amount'  => Numbers::jsonFormat($Totals['line_extension_amount'],2),        // Total Valor Bruto (Antes de tributos)
            'tax_exclusive_amount'   => Numbers::jsonFormat($Totals  ['tax_exclusive_amount'],2),       // Total Valor Base Imponible (Base imponible para el cálculo de los tributos)
            'tax_inclusive_amount'   => Numbers::jsonFormat($Totals  ['tax_inclusive_amount'],2),       // Total de Valor Bruto más tributos
            'payable_amount'         => Numbers::jsonFormat($Totals  ['payable_amount'],2),             // Valor de la Factura
        ];      
    }

    protected function DocSoporteInvoiceLinesTrait ( $Products, &$jsonObject, $jsonKey, $FechaTransacion  ) {
        $Productos = [];          
        foreach ($Products as $Product) {
         $ProductToCreate = [
             'invoiced_quantity'           => Numbers::jsonFormat ( $Product['invoiced_quantity'], 6),
             'vendor_code'                 => $Product['code'],
             'line_extension_amount'       => Numbers::jsonFormat ($Product['line_extension_amount'], 2),
             'invoice_period'              => [
                'start_date'                        =>  Fecha::YMD( $FechaTransacion) ,
                'form_generation_transmission_id'   => '1' ,  
             ],
             'description'                 => $Product['description'],
             'code'                        => $Product['code'],
             'price_amount'                => Numbers::jsonFormat ($Product['price_amount'],2),
             'base_quantity'               => Numbers::jsonFormat ($Product['base_quantity'],2)
           ];  
 
            $Productos[] = $ProductToCreate ;
        }
        $jsonObject [$jsonKey] = $Productos;
    }

 

    protected function traitDocumentSoportReponseSave( $id_fact_elctrnca, $dataResponse) {
        DocSoporteResponse::where('id_fact_elctrnca', $id_fact_elctrnca)->delete();
        $FctrasDataReponse = new DocSoporteResponse;
        $FctrasDataReponse->id_fact_elctrnca                   = $id_fact_elctrnca;
        $FctrasDataReponse->qr_data                            = $dataResponse['qr_data'];
        $FctrasDataReponse->attached_document_base64_bytes     = $dataResponse['attached_document_base64_bytes'];
        $FctrasDataReponse->application_response_base64_bytes  = '' ;
        $FctrasDataReponse->pdf_base64_bytes                   = '' ;
        $FctrasDataReponse->save(); 
    }


}
