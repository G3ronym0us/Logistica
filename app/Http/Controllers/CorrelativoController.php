<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Correlativo as Correlativo;

class CorrelativoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('correlativo.index');
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
        $this->validate($request, [
            'municipio_id' => 'required',
            'n_partida' => 'required',
            'proyecto' => 'required',
            'beneficiario_id' => 'required',
            'orden_compra' => 'required'
        ]);

        Correlativo::create($request->all());

        return;
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
        $this->validate($request, [
            'municipio_id' => 'required',
            'n_partida' => 'required',
            'proyecto' => 'required',
            'beneficiario_id' => 'required',
            'orden_compra' => 'required'
        ]);

        Correlativo::find($id)->update($request->all());

        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $correlativo = Correlativo::find($id);
        $correlativo->delete();
    }
}
