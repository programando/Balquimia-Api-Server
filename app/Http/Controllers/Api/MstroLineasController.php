<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use App\Models\MstroLinea as Lineas;

class MstroLineasController extends Controller
{
    public function activas () {

        $Lineas =    Lineas::withCount(['prdctos'])
            ->where('inactivo','0')
            ->where('imagen','!=', '')
            ->orderBy('orden_web')->get();
        return  $Lineas->where('prdctos_count','>',0);
       
        
        /*$LIneas =    Lineas::withCount(['prdctos',
                    'prdctos as CantProductos' => function( $query ) {
                        $query->where('clave','BB1');
                    }])->where('inactivo','0')->orderBy('orden_web')->get();
                    */

    }
}
