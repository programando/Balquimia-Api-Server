<?php

namespace App\Traits;
 
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\NominaElctrncaXmlSequenceNumber as Nomina;
use App\Helpers\DatesHelper as Fecha;
use App\Helpers\NumbersHelper as Numbers;
use App\Helpers\StringsHelper as Strings;

trait NominaElctrncaTrait {


    protected function traitXmlSequenceNumber ( $XmlSequenceNumber, &$jsonObject ) {
        $jsonObject['sync']=true;
        $jsonObject['xml_sequence_number']=[
              'worker_code' => trim( $XmlSequenceNumber['worker_code'] ),
              'prefix'      => $XmlSequenceNumber['prefix'],
              'number'      => $XmlSequenceNumber['id_nomina_elctrnca']
        ];
    }


    protected function traitEnvironment ( &$jsonObject ) {
       $jsonObject['environment']=[
         'type_environment_id' => '1',                                      // 1 producction,   2 habilitacion o pruebas
         'id'                  => 'a21164d4-4ebb-45f6-a1fc-2562c51f5e8a',   // identitication
         'pin'                 => '55214',                                  // pin
       ]; 
    }
// 56a385de-6d08-4a67-98d7-d0c9d265c3ca
    protected function traitXmlProvider ( &$jsonObject ) {
       $jsonObject['xml_provider']=[
         'name' => 'BALQUIMIA S.A.S.',                                     
       ];
    }

   protected function traitGeneralInformation( $GeneralInformation,  &$jsonObject ) {
       $jsonObject['general_information']=[
         'date'              => $GeneralInformation[0]['date'],
         'payroll_period_id' => $GeneralInformation[0]['payroll_period_id'],
       ];
    }
   protected function traitEmployer(  &$jsonObject ) {
       $jsonObject['employer']=[
                  'identification_number' => '900755214',
                  'municipality_id'       => '1006',              //CALI
                  'address'               => 'CALLE 35 4 31',
       ];
    }

   protected function traitEmployee( $Employee, &$jsonObject ) {
       $jsonObject['employee']=[
               'type_worker_id'        => $Employee[0]['type_worker_id'],
               'subtype_worker_id'     => $Employee[0]['subtype_worker_id'],
               'high_risk_pension'     => $Employee[0]['high_risk_pension'],
               'identification_number' => $Employee[0]['identification_number'],
               'surname'               => trim ( $Employee[0]['surname']    ),
               'first_name'            => trim ( $Employee[0]['first_name'] ),
               'municipality_id'       => $Employee[0]['municipality_id'],
               'address'               => $Employee[0]['address'],
               'integral_salary'       => $Employee[0]['integral_salary'],
               'type_contract_id'      => $Employee[0]['type_contract_id'],
               'salary'                => $Employee[0]['salary'],
 
       ];
    }

   protected function traitPeriod( $Period, &$jsonObject ) {
      $jsonObject['period']=[
                'admission_date'        => $Period[0]['admission_date'],
                'settlement_start_date' => $Period[0]['settlement_start_date'],
                'settlement_end_date'   => $Period[0]['settlement_end_date'],
                'amount_time'           => $Period[0]['amount_time'],
                'date_issue'            => $Period[0]['date_issue'],
       ];
    }
   protected function traitPayment( $Payment, &$jsonObject ) {
      $jsonObject['payment']=[
                'payment_form_id'   => $Payment[0]['payment_form_id'],
                'payment_method_id' => $Payment[0]['payment_method_id'],
       ];
    }

   protected function traitPaymentDates( $Period, &$jsonObject ) {
      $PaymentDates = [
          'date'    => $Period[0]['settlement_end_date']
      ];
      $jsonObject['payment_dates'][] =$PaymentDates;
    }
 

   protected function traitEarBasic( $Ear, &$jsonObject ) {
      $Basic = [
          'worked_days'      => $Ear[0]['basic_worked_days'],
          'worker_salary'    => $Ear[0]['basic_worker_salary']
      ];
      $jsonObject['earn']['basic'] =$Basic;
    }

   protected function traitDeductions( $Deductions, &$jsonObject ) {
      $health = [
          'percentage'      => $Deductions[0]['health_percentage'],
          'payment'         => $Deductions[0]['health_payment']
      ];
      $pension_fund = [
          'percentage'      => $Deductions[0]['pension_fund_percentage'],
          'payment'         => $Deductions[0]['pension_payment']
      ];      
      $jsonObject['deduction']['health']       = $health;
      $jsonObject['deduction']['pension_fund'] = $pension_fund;
    }


   protected function traitTotals( $Empleado, &$jsonObject ) {
       $jsonObject['accrued_total']    = $Empleado['accrued_total'];
       $jsonObject['deductions_total'] = $Empleado['deductions_total'];
       $jsonObject['total']            = $Empleado['total']; 
    }


       protected function traitDocumentSuccessResponse( $id_nomina_elctrnca, $dataResponse ){
            $Registro = Nomina::findOrFail( $id_nomina_elctrnca );
            $Registro['is_valid']           = $dataResponse['is_valid'];
            $Registro['number_dian']        = $dataResponse['number'];
            $Registro['uuid']               = $dataResponse['uuid'];
            if ( is_null($dataResponse['zip_key']) ){
                $Registro['zip_key']            =   '';
            }else{
              $Registro['zip_key']            =   $dataResponse['zip_key'];
            }

            $Registro['status_description'] = substr( $dataResponse['status_description'],0,250 );
            $Registro['status_message']     = substr( $dataResponse['status_message'], 0,250 );
            $Registro['xml_file_name']      = $dataResponse['xml_name'];
            $Registro['zip_name']           = $dataResponse['zip_name'];
            $Registro['rpte_dian']          = true;
            $Registro->save();  
        }
 
  }
?>