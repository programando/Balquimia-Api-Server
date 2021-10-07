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

       public function dianReporting () {
              $URL = 'payroll/102/99727e02-ef5e-4259-afc0-29ee8829e87b'  ;
              $requestNomina = true ;
              $Empleados = Nomina::dianReporting();
              foreach ($Empleados as $Empleado ) {
                  $this->reportingInformation ( $Empleado );
                  $response   = $this->ApiSoenac->postRequest( $URL, $this->jsonObject, $requestNomina ) ;  
                  return  $response ;
              }
             //return $this->jsonObject;
       }


       private function reportingInformation ( $Empleado ) {
            $this->jsonObject = [];
            $id_nomina_elctrnca = $Empleado['id_nomina_elctrnca'];    
            $otherData          = Nomina::with('generalInformation', 'employee', 'period','payment','earns','deductions')->where('id_nomina_elctrnca','=', $id_nomina_elctrnca)->get();  
            $this->jsonObjectCreate ($Empleado, $otherData  )   ;
       }

       private function jsonObjectCreate ( $Empleado, $otherData ) {
              
              //dd ( $otherData[0]['generalInformation']['date']);
              $this->traitXmlSequenceNumber      ( $Empleado                             ,  $this->jsonObject  ) ;
              $this->traitEnvironment            ( $this->jsonObject                                             ) ;
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
