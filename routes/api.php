<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('getBeneficiarios', function(Request $request){
    $beneficiarios = App\Beneficiario::orderBy('id', 'DESC')->paginate(5);
    return [
        'pagination' => [
            'total' => $beneficiarios->total(),
            'current_page' => $beneficiarios->currentPage(),
            'per_page' => $beneficiarios->perPage(),
            'last_page' => $beneficiarios->lastPage(),
            'from' => $beneficiarios->firstItem(),
            'to' => $beneficiarios->lastItem(),
        ],
        'beneficiarios' => $beneficiarios
    ];
});

Route::get('getCorrelativo/{id}', function(Request $request){
    return App\Correlativo::find($id);
});

Route::get('getCorrelativos', function(Request $request){
    $correlativos = DB::table('correlativos')
            ->join('municipios', 'municipios.id', '=', 'correlativos.municipio_id')
            ->join('beneficiarios', 'beneficiarios.id', '=', 'correlativos.beneficiario_id')
            ->select('correlativos.*', 'municipios.name as municipio', 'beneficiarios.name as beneficiario')
            ->orderBy('id', 'DESC')
            ->paginate(8);
    for ($i=0; $i < count($correlativos) ; $i++) { 
        $correlativos[$i]->created_at = substr($correlativos[$i]->created_at,0,10);
    }
    return $correlativos;
});

Route::get('getMunicipios', function(Request $request){
    $municipios = App\Municipio::all();
    return $municipios;
});

Route::get('getBeneficiariosFull', function(Request $request){
    $beneficiarios = App\Beneficiario::orderBy('id', 'DESC')->paginate(10);
    return [
        'pagination' => [
            'total'         => $beneficiarios->total(),
            'current_page'  => $beneficiarios->currentPage(),
            'per_page'      => $beneficiarios->perPage(),
            'last_page'     => $beneficiarios->lastPage(),
            'from'          => $beneficiarios->firstItem(),
            'to'            => $beneficiarios->lastItem(),
        ],
        'beneficiarios' => $beneficiarios
    ];;
});

