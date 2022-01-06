<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Mail;
use App\Mail\TercerosNominaWasReported;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\TercerosNominaWasReportedEvent;

class TercerosNominaWasReportedListener
{
  
    public function handle(TercerosNominaWasReportedEvent $event)
    {
         Mail::to( 'contabilidad@balquimia.com')
          ->cc(  'jhonjamesmg@hotmail.com')
          //->cc( config('company.EMAIL_CARTERA') )
          ->queue(   new TercerosNominaWasReported ($event->Empleados ));
    }
}
