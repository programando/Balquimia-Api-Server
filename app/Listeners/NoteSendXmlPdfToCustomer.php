<?php

namespace App\Listeners;

use App\Events\NoteWasCreatedEvent;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\CreditNoteSentToCustomerMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use config;

class NoteSendXmlPdfToCustomer
{
     
    public function handle(NoteWasCreatedEvent $event) {
        
        // $EmailSubject  .= ';91;' => Tipo documento nota crédito según tabla de la DIAN. Juio 24 2020

        $EmailSubject   = config('company.NIT').";".config('company.EMPRESA').";".$event->Note['prfjo_dcmnto'] .$event->Note['nro_dcmnto'] ;
        $EmailSubject  .= ';91;'.config('company.EMPRESA');

        $Emails =   $event->Note['emails']->unique('email')  ;     
        $when   = now()->addSeconds(5);
        Mail::to( $Emails )
                  ->cc('auxcontable@fqesas.com')
                  ->later( $when,new CreditNoteSentToCustomerMail(
                            $event->Note ,
                            $event->FilePdf, $event->FileXml, 
                            $event->PathPdf, $event->PathXml,
                            $EmailSubject, 
                            $event->ZipPathFile, $event->ZipFile
                            ));
    }
}
