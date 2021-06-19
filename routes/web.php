<?php
use Illuminate\Support\Facades\Route;

/* DB::listen(function($query) {
echo "<pre>{$query->sql} - {$query->time}</pre>";
});
 */
Route::get('/', function (Request $request) {
    echo (env('DB_HOST') );
    echo (env('DB_DATABASE') );
 

    return view('welcome');
});

 
//FRASE DEL DÍA
Route::get('frase'          , 'FrasesController@sentenceToday');

//CONTACTOS
Route::post('contactos', 'TercerosContactatosController@saveContacto');

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
