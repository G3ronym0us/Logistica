<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetallesCorrelativo as DetallesCorrelativo;
use App\Correlativo as Correlativo;

class DetallesCorrelativoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('detalles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $detalles=$request->get('detalles');
        print_r($detalles);
        $correlativo_latest = Correlativo::latest('id')->first();
        $cont = 0;
        while ($cont < count($detalles)) {
            $detalleNew = new DetallesCorrelativo();
            $detalleNew->correlativo_id = $correlativo_latest->id;
            $detalleNew->catalogo_id = $detalles[$cont]['catalogo_id'];
            $detalleNew->cantidad = $detalles[$cont]['cantidad'];
            $detalleNew->subtotal = $detalles[$cont]['valor_total'];
            $detalleNew->save();
            $cont++;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
