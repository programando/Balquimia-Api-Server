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
             return $response ;
       }
       
       
       public function dianReporting () {
              $URL = 'payroll/102/99727e02-ef5e-4259-afc0-29ee8829e87b'  ;
              $requestNomina = true ;
              $Empleados = Nomina::dianReporting();
              foreach ($Empleados as $Empleado ) {
                  $this->reportingInformation ( $Empleado );
                  //return $this->jsonObject;
                  $response   = $this->ApiSoenac->postRequest( $URL, $this->jsonObject, $requestNomina ) ;  
                  return  $response ;
              }
             //return $this->jsonObject;
       }

       public function notaAjusteNomina () {
              $this->jsonObject['sync']=false;
              $this->traitEnvironment            ( $this->jsonObject                                             ) ;
              $payroll_reference =[
                            "number"     => "NOM258",
                            "uuid"       => "b06b864c22bfe62d71d052538f29d6167c4bb04c1db60e7a57b5fc96198ac0b03aafdadece3dc1ed1be55cd813424099",
                            "issue_date" => "2021-10-14"
              ];
              $xml_sequence_number =[
                            "prefix"=> "NOM",
                            "number"=> 258
              ];
              $general_information =["payroll_period_id"=> "5",  ];    
              $employer =[
                            "identification_number" => 1005877831,
                            "municipality_id"       => 1006,
                            "address"               => "XYZ - 123"
              ];                        
              $this->jsonObject['type_payroll_note_id'] = '2' ;
              $this->jsonObject['payroll_reference']    = $payroll_reference;
              $this->jsonObject['xml_sequence_number']  = $xml_sequence_number;
              $this->jsonObject['general_information']  = $general_information;
              $this->jsonObject['employer']             = $employer;

              //return  $this->jsonObject  ;
              $URL                 = 'payroll/103/99727e02-ef5e-4259-afc0-29ee8829e87b'  ;
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

}
