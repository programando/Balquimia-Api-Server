<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\NominaElctrncaXmlSequenceNumber as Nomina;

use App\Helpers\DatesHelper;
use App\Helpers\GeneralHelper  ;

use App\Traits\ApiSoenac;
use App\Traits\PdfsTrait;
use App\Traits\QrCodeTrait;
use App\Traits\NominaElctrncaTrait;
 

Use Storage;
Use Carbon;
use config;

class NominaElctrncaController extends Controller
{
       use  ApiSoenac, QrCodeTrait, PdfsTrait, NominaElctrncaTrait;
       private $jsonObject = [] , $jsonResponse = [];

       
       public function zipKey ($ZipKey) {
             $URL                         = "ubl2.1/status/zip/$ZipKey"  ;   
             $requestNomina               = true ;
             $this->jsonObject['environment']['url']     = 'https://vpfe-hab.dian.gov.co/WcfDianCustomerServices.svc?wsdl'  ;
             $response                    = $this->ApiSoenac->postRequest( $URL, $this->jsonObject, $requestNomina ) ; 
             $this->documentsProcessReponse( '365', $response ) ;
             return $response;
       }
       
       
       public function dianReporting () {
              $URL           = 'payroll/102/845ee3d1-c109-45b5-8cc1-96968c97d7a4'  ;
              $requestNomina = true ;
              $Empleados     = Nomina::dianReporting();
              foreach ($Empleados as $Empleado ) {
                  $this->reportingInformation ( $Empleado );
                  //return $this->jsonObject;
                  $response   = $this->ApiSoenac->postRequest( $URL, $this->jsonObject, $requestNomina ) ;  
                  $this->documentsProcessReponse( $Empleado['id_nomina_elctrnca'], $response ) ;
                  return  $response ;
              }
             //return $this->jsonObject;
       }

       public function notaAjusteNomina () {
              $this->jsonObject['sync'] = true;
              $this->traitEnvironment            ( $this->jsonObject                                             ) ;
              $payroll_reference =[
                            "number"     => "NOM314",
                            "uuid"       => "c3b4ea68246f416fa0deb9683f30901c038192a3ac5cbd9dab686608ceb869e607500d5806232c5d186144a9fdad9d87",
                            "issue_date" => "2021-10-14"
              ];
              $xml_sequence_number =[
                            "prefix"=> "NOM",
                            "number"=>45
              ];
              $general_information =["payroll_period_id"=> "5",  ];    
                     
              $this->jsonObject['type_payroll_note_id'] = '2' ;
              $this->jsonObject['payroll_reference']    = $payroll_reference;
              $this->jsonObject['xml_sequence_number']  = $xml_sequence_number;
              $this->jsonObject['general_information']  = $general_information;
              $this->traitEmployer               ( $this->jsonObject                                             ) ;
              $URL                 = 'payroll/103/845ee3d1-c109-45b5-8cc1-96968c97d7a4'  ;
              $requestNomina       = true ;
              $response            = $this->ApiSoenac->postRequest( $URL, $this->jsonObject, $requestNomina ) ; 
              return  $response  ;
       }

       private function reportingInformation ( $Empleado ) {
            $this->jsonObject   = [];
            $id_nomina_elctrnca = $Empleado['id_nomina_elctrnca'];    
            $otherData          = Nomina::with('generalInformation', 'employee', 'period','payment','earns','deductions')->where('id_nomina_elctrnca','=', $id_nomina_elctrnca)->get();  
            $this->jsonObjectCreate ( $Empleado,  $otherData  )   ;
       }

       private function jsonObjectCreate ( $Empleado, $otherData ) {
              
              //dd ( $otherData[0]['generalInformation']['date']);
              $this->traitXmlSequenceNumber      ( $Empleado                             ,  $this->jsonObject  ) ;
              $this->traitEnvironment            ( $this->jsonObject                                             ) ;
              $this->traitXmlProvider            ( $this->jsonObject                                             ) ;
              $this->traitGeneralInformation     ( $otherData[0]['generalInformation']   ,  $this->jsonObject  ) ;
              $this->traitEmployer               ( $this->jsonObject                                             ) ;
              $this->traitEmployee               ( $otherData[0]['employee']             ,  $this->jsonObject  ) ;
              $this->traitPeriod                 ( $otherData[0]['period']               ,  $this->jsonObject  ) ;
              $this->traitPayment                ( $otherData[0]['payment']              ,  $this->jsonObject  ) ;
              $this->traitPaymentDates           ( $otherData[0]['period']               ,  $this->jsonObject  ) ;
              $this->traitEarBasic               ( $otherData[0]['earns']                ,  $this->jsonObject  ) ;
              $this->traitDeductions             ( $otherData[0]['deductions']           ,  $this->jsonObject  ) ;
              $this->traitTotals                 ( $Empleado                             ,  $this->jsonObject  ) ;

       }


        private  function documentsProcessReponse($id_nomina_elctrnca,  $response ){

            if ( array_key_exists('is_valid',$response) ) {
                $this->responseContainKeyIsValid ( $id_nomina_elctrnca, $response );                 
            } //else {       
                //$this->traitdocumentErrorResponse( $id_nomina_elctrnca, $response ); 
            //}
        }

    private function responseContainKeyIsValid($id_nomina_elctrnca , $response ){
             
        if ( $response['is_valid'] == true || is_null( $response['is_valid'] ) ) {
            $this->traitDocumentSuccessResponse ( $id_nomina_elctrnca , $response );
        } //else {
            //$this->traitdocumentErrorResponse( $id_nomina_elctrnca, $response );     
        //}
    }


}
