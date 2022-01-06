<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TercerosNominaWasReportedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $Empleados;
    public function __construct( $Empleados)
    {
        $this->Empleados = $Empleados;
    }

}
