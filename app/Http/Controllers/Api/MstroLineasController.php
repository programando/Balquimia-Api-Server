<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use App\Models\MstroLinea as Lineas;

class MstroLineasController extends Controller
{
    public function activas () {
        return     Lineas::where('inactivo','0')->orderBy('orden_web')->get();
    }
}
