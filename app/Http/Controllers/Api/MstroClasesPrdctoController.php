<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MstroClasesPrdcto as ProductosClases ;

class MstroClasesPrdctoController extends Controller
{
    
    public function getClasesPorLinea (Request $FormData  ) {
        return ProductosClases::getClasesPorLinea ($FormData->idlinea ) ;
    }


}
