<?php

namespace App\Traits;
 
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use App\Helpers\DatesHelper as Fecha;
use App\Helpers\NumbersHelper as Numbers;
use App\Helpers\StringsHelper as Strings;

trait NominaElctrncaTrait {


    protected function traitXmlSequenceNumber ( $XmlSequenceNumber, &$jsonObject ) {
        $jsonObject['sync']=true;
        $jsonObject['xml_sequence_number']=[
              'worker_code' => trim( $XmlSequenceNumber['worker_code'] ),
              'prefix'      => $XmlSequenceNumber['prefix'],
              'number'      => $XmlSequenceNumber['number']
        ];
    }


    protected function traitEnvironment ( &$jsonObject ) {
       $jsonObject['environment']=[
         'type_environment_id' => '2',                                      // 1 producction,   2 habilitacion o pruebas
         'id'                  => 'e777680e-2f6b-40f2-9f65-cd61a20186c5',   // identitication
         'pin'                 => '55214',                                  // pin

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
      $jsonObject['basic'][] =$Basic;
    }

   protected function traitDeductions( $Deductions, &$jsonObject ) {
      $health = [
          'percentage'      => $Deductions[0]['health_percentage'],
          'payment'    => $Deductions[0]['health_payment']
      ];
      $pension_fund = [
          'percentage'      => $Deductions[0]['pension_fund_percentage'],
          'payment'    => $Deductions[0]['pension_payment']
      ];      
      $jsonObject['deduction']['health'] =$health;
       $jsonObject['deduction']['pension_fund'] =$pension_fund;
    }


   protected function traitTotals( $Empleado, &$jsonObject ) {
       $jsonObject['accrued_total']    = $Empleado['accrued_total'];
       $jsonObject['deductions_total'] = $Empleado['deductions_total'];
       $jsonObject['total']            = $Empleado['total']; 
    }







  }
?>