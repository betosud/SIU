<?php

namespace SIU\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use SIU\Http\Requests;
use SIU\Http\Controllers\Controller;
use SIU\indicadores;
use SIU\indicadoresbarrios;

class IndicadoresBarriosController extends Controller
{
    public function indexvalores()
    {
        $valores=array();
//        $valores= indicadoresbarrios::indicadoresbarrio(Auth::user()->idbarrio,'REAL')->orderby('id')->get();
//        dd($valores);
        $indicadores=indicadores::all();
        foreach($indicadores as $indicador){
            $opciones=explode(',',$indicador->opciones);
            foreach($opciones as $opcion){
                $resultado[$opcion]=indicadoresbarrios::indicadoresbarrio(Auth::user()->idbarrio,$opcion,$indicador->id)->get();

            }
            $valores[$indicador->id]=$resultado;
        }

        return view('indicadores.indicadores',compact('indicadores','valores'));
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
        //
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
//        dd($request);

        $rules=array('valor'=>'required|numeric');
        $validacion= $this->validate($request,$rules);
        $indicador=indicadoresbarrios::find($id);


//        dd($request);


        $indicador->fill($request->all());
        $indicador->save();
        return response()->json([
            'error'=>$validacion,'mensaje'=>'Se actualizo '.$indicador->tipo." del indicador ".$indicador->idindicador
        ]);
//        return response()->json(['mensaje'=>'Registro Actualizado']);
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
