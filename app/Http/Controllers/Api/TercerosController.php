<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tercero as Terceros;
use App\Models\BtcraVta as BitacoraVentas;

class TercerosController extends Controller
{
       public function clientesBuscarNomSucNitNomCcial(Request $FormData ){    
          $Clientes = Terceros::clientesActivosPorVendedor( $FormData->idTercVendedor )
                      ->clientesBuscarNomSucNitNomCcial( $FormData->filtroBusqueda)
                      ->select('nro_identif','id_terc','nom_full','nom_suc', 'id_terc_vend_ppal', 'cod_vendedor', 'nom_vendedor')
                      ->orderBy('nom_full')->get();
                                 
           return  $Clientes;
    }

    public function clientesProductosComprados ( Request $FormData ) {
        return BitacoraVentas::clientesProductosComprados( $FormData->id_terc );
    }

}
