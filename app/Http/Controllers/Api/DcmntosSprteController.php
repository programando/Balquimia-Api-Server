<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Traits\ApiSoenac;
use App\Traits\PdfsTrait;
use App\Traits\QrCodeTrait;
use App\Traits\FctrasElctrncasTrait;
use App\Traits\DocsSoporteTrait;

use App\Helpers\DatesHelper;
use App\Helpers\GeneralHelper  ;

use App\Models\FctrasElctrnca   ;
use App\Models\FctrasElctrncasErrorsMessage as ErrorResponse   ;
use App\Models\FctrasElctrncasMcipio;
use App\Models\DcmntosSprteWithholdingTaxTotal;
 
use App\Events\InvoiceWasCreatedEvent;


Use Storage;
Use Carbon;


class DcmntosSprteController extends Controller {

    use FctrasElctrncasTrait, ApiSoenac, QrCodeTrait, PdfsTrait, DocsSoporteTrait;
    private $jsonObject = [] , $jsonResponse = []; 

    public function documentosSoporte () {
        $URL        = 'document-support' ;
        $Documentos = FctrasElctrnca::DocumentosSoporteToSend();
         
        foreach ($Documentos as $Documento ) {
            $this->reportingInformation ( $Documento );
            return $this->jsonObject;
            /*$response   = $this->ApiSoenac->postRequest( $URL, $this->jsonObject) ;  
            $this->traitUpdateJsonObject ( $Documento );
            $this->errorResponse  ( $response , $Documento['id_fact_elctrnca']  );
            $this->successReponse ( $response , $Documento['id_fact_elctrnca']  );*/
            return  $response ;
        }
    }


    private function successReponse ( $response, $IdFactElctrnca) {
        if ( $response['is_valid'] == true ) {
            $this->traitDocumentSuccessResponse   ( $IdFactElctrnca, $response );
            $this->traitDocumentSoportReponseSave ( $IdFactElctrnca, $response );
        }
    }


    private function errorResponse ( $response, $IdFactElctrnca) {
        if ( $response['is_valid'] == false ) {
            $Erors   = $response['errors_messages'] ;
            foreach ($erors as $Error) {
                 $NewError                   = new ErrorResponse ;
                 $NewError->id_fact_elctrnca = $IdFactElctrnca;
                 $NewError->error_message    = $Error;
                 $NewError->fecha            = $Carbon::now();
                 $NewError->save();
            }
        }
    }


    private function reportingInformation ( $DocSoporte ) {
        $this->jsonObject   = [];
        $id_fact_elctrnca = $DocSoporte['id_fact_elctrnca'];    
        $otherData          = FctrasElctrnca::with('customer', 'docsSoporteRetenciones', 'total','products')->where('id_fact_elctrnca','=', $id_fact_elctrnca)->get();  
       
        $this->jsonObjectCreate ( $DocSoporte,  $otherData  )   ;
   }


   private function jsonObjectCreate ( $DocSoporte, $otherData ) {
        $this->DocSoporteHeaderTrait                ( $DocSoporte                               ,  $this->jsonObject    , $DocSoporte['fcha_dcmnto'] )   ;  
        $this->DocSoporteResolutionTrait            ( $this->jsonObject                                                                              )   ;  
        $this->DocSoporteEnvironmentTrait           ( $this->jsonObject                                                                         )   ;
        $this->traitCustomer                        ( $otherData[0]['customer']                 , $this->jsonObject                             )   ;   
        $this->DocSoporteLegalMonetaryTotalsTrait   ( $otherData[0]['total']                    , $this->jsonObject, 'legal_monetary_totals'    )   ;
        $this->DocSoporteInvoiceLinesTrait          ( $otherData[0]['products']                 , $this->jsonObject, 'invoice_lines' , $DocSoporte['fcha_dcmnto']           )   ; 
   }




}